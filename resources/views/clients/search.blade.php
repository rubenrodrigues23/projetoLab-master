@extends('layouts.app')

@section('content')
<h1>Search Results</h1>

@if (count($results) > 0)
<ul class="list-group">
  @foreach ($results as $result)
  <li class="list-group-item">
    <h5>{{$result->name}}</h5>
    <h5>{{$result->price}}€</h5>
    @if(Auth::user()->is_admin)
    <form action="{{ route('clients.destroyAdmin',$result->id) }}" method="POST">
      <a class="btn btn-info" href="{{ route('clients.showAdmin',$result->id) }}">Show</a>
      <a class="btn btn-primary" href="{{ route('clients.editAdmin',$result->id) }}">Edit</a>
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    @else
    <a class="btn btn-info" href="{{ route('clients.show',$result->id) }}">Show</a>
    <a class="btn btn-info" href="{{ route('stripe.get',$result->id) }}">Buy</a>
    @endif
  </li>
  @endforeach
</ul>
@else
<p>No results found.</p>
@endif
@endsection