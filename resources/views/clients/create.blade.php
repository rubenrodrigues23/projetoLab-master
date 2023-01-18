@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Advert</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('clients.myadverts') }}"> Back</a>
        </div>
    </div>
</div>

<form action="{{route('clients.store')}}" method="post">
    @csrf {{-- <- Required for protection or the form is rejected --}} 
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Price:</strong>
                <input type="number" name="price" class="form-control" placeholder="Price">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <input type="text" name="description" class="form-control" placeholder="Description">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card-body">
                @if ($message = Session::get('status'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
               
            </div>
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
</form>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@endsection