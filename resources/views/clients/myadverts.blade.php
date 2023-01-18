@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<ul class="list-group">
  @forelse($clients as $client)
  @if($client->user_id == Auth::user()->id)
  <li class="list-group-item">
    <h5>{{$client->name}}</h5>
    <h5>{{$client->price}}€</h5>
    <form action="{{ route('clients.destroy',$client->id) }}" method="POST">
      <a class="btn btn-info" href="{{ route('clients.showMyAdverts',$client->id) }}">Show</a>
      <a class="btn btn-primary" href="{{ route('clients.edit',$client->id) }}">Edit</a>
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete</button>
    </form>
  </li>
  @endif
  @empty
  
  @endforelse
</ul>
{!! $clients->links('pagination::bootstrap-4') !!}

@endsection