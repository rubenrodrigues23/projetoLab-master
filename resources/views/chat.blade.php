@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <form action="{{ route('chat.changeCurrentUser')}}" method="POST">
        <div class="panel-heading">Chats:
            <select name="changeCurrentUser">
                @foreach($uniqueUsers as $uniqueUser)
                <option value="{{ $uniqueUser }}" @click="changeCurrentUser">{{$uniqueUser}}</option>
                @endforeach
            </select>
        </div>
    </form>
    <div class="row">
        <div class="col">
            <div class="panel panel-default">
                @forelse($messages as $message)
                @if($message->user->name == $currentUser)
                <div class="panel-body">
                    <ul class="chat">
                        <li class="left clearfix" v-for="message in messages">
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">
                                        {{ $message->user->name }}
                                    </strong>
                                </div>
                                <p>
                                    {{ $message->message }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                                Send
                            </button>
                        </span>
                    </div>
                </div>
                @endif
            </div>
            @empty
            <h5 class="text-center">You Have No Messages!</h5>
            @endforelse
        </div>
    </div>
</div>
@endsection