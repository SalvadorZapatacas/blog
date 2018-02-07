@extends('admin.layouts.layout')


@section('header')

    <h1>
        <small>Crear</small>
        Post
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> Posts</a></li>
        <li class="active">Crear Post</li>
    </ol>

@endsection


@section('content')

    <!-- Usando Styde/html pasarlo de vanilla a librería -->
    <div class="row">
        <form action="">
            {{ csrf_field() }}

            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Título de la publicación</label>
                            <input type="text" name="title" class="form-control" placeholder="Escribe el título de la publicación">
                        </div>
                        <div class="form-group">
                            <label for="">Contenido de la publicación</label>
                            <textarea name="body" class="form-control" rows="10" placeholder="Escribe el contenido de la publicacion"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Extracto de la publicación</label>
                            <textarea name="excerpt" class="form-control" placeholder="Resumen de la publicación" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
