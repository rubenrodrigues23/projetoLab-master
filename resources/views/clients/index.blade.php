@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
@forelse($clients as $client)
<ul class="list-group">
    <li class="list-group-item">
        <h5>{{$client->name}}</h5>
        <h5>{{$client->price}}€</h5>
        @if(Auth::user()->is_admin)
        <form action="{{ route('clients.destroyAdmin',$client->id) }}" method="POST">
            <a class="btn btn-info" href="{{ route('clients.showAdmin',$client->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('clients.editAdmin',$client->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        @elseif($client->user_id == Auth::user()->id)
        <a class="btn btn-info" href="{{ route('clients.show',$client->id) }}">Show</a>
        @else
        <a class="btn btn-info" href="{{ route('stripe.get',$client->id) }}">Buy</a>
        <a class="btn btn-info" href="{{ route('clients.show',$client->id) }}">Show</a>
        @endif
    </li>
    @empty
    <h5 class="text-center">No Adverts Found!</h5>
    @endforelse
    <form method="GET" action="{{ route('clients.search',$client->id) }}">
        <input type="text" name="query" placeholder="Search">
        <button type="submit">Search</button>
    </form>
</ul>
{!! $clients->links('pagination::bootstrap-4') !!}

@endsection