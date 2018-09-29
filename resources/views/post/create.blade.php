@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agrega Publicaciones
                </div>

                <div class="card-body">
                    <form action="{{ url('/post/store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="content">¿En qué estas pensando?</label>
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
