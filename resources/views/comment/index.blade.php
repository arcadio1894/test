@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Post: {{ $post->content }}
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($post->comments as $comment)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <p>{{ $comment->user->name }}:</p>
                                <p>{{ $comment->content }}</p>
                            </li>
                        @endforeach
                        <span id="list-view"></span>
                    </ul>
                    <form action="{{ url('/comment/post/'.$post->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="content">Agregar comentario</label>
                            <input type="text" class="form-control" id="content" name="content">
                        </div>

                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        window.Echo.channel('comments').listen('CommentCreated', function (data) {
            //console.log(data);
            const comment = data.comment;

            let commentHTML = '<li class="list-group-item d-flex justify-content-between align-items-center">';
            commentHTML += '<p>'+ comment.user.name +':</p>';
            commentHTML += '<p>'+ comment.content +'</p></li>';
            $('#list-view').before(commentHTML);
        })
    </script>
@endsection
