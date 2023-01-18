@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Advert</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('clients.myadverts') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $client->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Price:</strong>
            {{ $client->price }}€
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Description:</strong>
            {{ $client->description }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Seller:</strong>
            {{ $client->user->email }}
        </div>

    </div>
    @include('partials.upload')
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            @foreach($photos as $photo)
            @if ($photo->client_id == $client->id)
            <img class="image" src="{{asset('/storage/images/'.$photo->path)}}" alt="client_image" style="width: 380px;height: 380px; padding: 10px; margin-left: 30px; ">
            @endif
            @endforeach
        </div>
    </div>
</div>
<h4>Add comment</h4>
<form method="post" action="{{ route('comments.store') }}">
    @csrf
    <div class="form-group">
        <textarea class="form-control" name="body"></textarea>
        <input type="hidden" name="client_id" value="{{ $client->id }}" />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Add Comment" />
    </div>
</form>
<h4>Display Comments</h4>
@include('clients.commentsDisplay', ['comments' => $client->comments, 'client_id' => $client->id])
@endsection