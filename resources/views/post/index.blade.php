@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Publicaciones
                    <a class="btn btn-primary" href="{{ url('/posts/create') }}">Crear</a>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($posts as $post)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $post->content }}
                                <a class="btn btn-success" href="{{ url('/post/'.$post->user->name.'/'.$post->id) }}">Ver comentarios</a>
                                <a class="btn btn-info" href="{{ url('/post/edit/'.$post->id) }}">Editar</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
