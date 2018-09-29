@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Publicacion {{ $post->id }}
                </div>

                <div class="card-body">
                    <form action="{{ url('/posts/update') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $post->id }}">
                        <div class="form-group">
                            <label for="content">Texto de la publicación</label>
                            <input type="text" class="form-control" value="{{ $post->content }}" id="content" name="content">
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
