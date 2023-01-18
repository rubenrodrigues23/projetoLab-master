@foreach($comments as $comment)
<div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
  <strong>{{ $comment->user->name }}</strong>
  <p>{{ $comment->body }}</p>
  <a href="" id="reply"></a>
  <form method="post" action="{{ route('comments.store') }}">
    @csrf
    <div class="form-group">
      <input type="text" name="body" class="form-control" />
      <input type="hidden" name="client_id" value="{{ $client_id }}" />
      <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
      <input type="submit" class="btn btn-warning" value="Reply" />
    </div>
  </form>
  <div class="form-group">
    @if(Auth::user()->is_admin || $client->user_id == Auth::user()->id)
    <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    @endif
  </div>
  @include('clients.commentsDisplay', ['comments' => $comment->replies])
</div>
@endforeach