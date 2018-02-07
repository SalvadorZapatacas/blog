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
                        <div class="box-body">
                            <!-- Date -->
                            <div class="form-group">
                                <label>Fecha de publicación:</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker">
                                </div>
                                <!-- /.input group -->
                            </div>


                            <div class="form-group">
                                <label for="">Categorías</label>
                                <select name="category_id" class="form-control" id="form_control">
                                    <option value="">Selecciona una categoría</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="">Extracto de la publicación</label>
                                <textarea name="excerpt" class="form-control" placeholder="Resumen de la publicación" rows="10"></textarea>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Guardar publicación</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection


@push('styles')

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/adminle/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

@endpush

@push('scripts')
    <!-- bootstrap datepicker -->
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('#datepicker').datepicker({
            autoclose: true
        })
    </script>
@endpush
