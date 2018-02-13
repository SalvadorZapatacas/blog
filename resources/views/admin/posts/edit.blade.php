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
        <form action="{{ route('admin.posts.update' , $post) }}" method="POST">
            {{ csrf_field() }} {{ method_field('PUT') }}

            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="">Título de la publicación</label>
                            <input type="text" name="title" class="form-control" placeholder="Escribe el título de la publicación" value="{{ old('title' , $post->title) }}">
                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            <label for="">Contenido de la publicación</label>
                            <textarea name="body" id="editor" class="form-control" rows="10" placeholder="Escribe el contenido de la publicacion">{{ old('body' ,$post->body) }}</textarea>
                            {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
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
                                    <input type="text" name="published_at" class="form-control pull-right" value="{{ old('published_at' , $post->published_at ? $post->published_at->format('m/d/Y') : null ) }}" id="datepicker">
                                </div>
                                <!-- /.input group -->
                            </div>


                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                <label for="">Categorías</label>
                                <select name="category_id" class="form-control" id="form_control">
                                    <option value="">Selecciona una categoría</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                {{ old('category_id',$post->category_id) == $category->id ? 'selected' : ''}}
                                        >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                                <label>Etiquetas</label>
                                <!-- HAY QUE INDICAR EN EL NOMBRE QUE ES UN ARRAY PARA RECIBIR TODOS LOS DATOS -->
                                <select name="tags[]"
                                        class="form-control select2"
                                        multiple="multiple"
                                        data-placeholder="Selecciona una o más etiqueta/s"
                                        style="width: 100%;"
                                >
                                    <option value=""></option>

                                    @foreach($tags as $tag)
                                        <option {{ collect(old('tags',$post->tags->pluck('id')->all()))->contains($tag->id) ? 'selected' : '' }}
                                                value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
                            </div>



                            <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                                <label for="">Extracto de la publicación</label>
                                <textarea id="excerpt" name="excerpt" class="form-control" placeholder="Resumen de la publicación" rows="10"> {{ old('excerpt',$post->excerpt) }} </textarea>
                                {!! $errors->first('excerpt', '<span class="help-block">:message</span>') !!}


                                <div class="form-group">
                                    <div class="dropzone">

                                    </div>
                                </div>


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
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
    <!-- Dropzone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.css" />

    <style>
        #excerpt{
            resize: vertical;
        }
    </style>

@endpush

@push('scripts')
    <!-- bootstrap datepicker -->
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- CK Editor -->
    <script src="/adminlte/bower_components/ckeditor/ckeditor.js"></script>
    <!-- Select2 -->
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- Dropzone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>


    <script>

        $('#datepicker').datepicker({
            autoclose: true
        });
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor');
        });

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
        });

        var myDropzone = new Dropzone('.dropzone', {
           url : '/admin/posts/{{ $post->slug }}/photos',
            paramName : 'photo',
            accerptedFiles: 'image/*',
            maxFilesize : 0.2,
            headers : {
              'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            },
           dictDefaultMessage : 'Arrastra aquí tus fotos para subirlas'
        });

        myDropzone.on('error', function(file, res){
            var msg = res.errors.photo[0];
            $('.dz-error-message:last > span').text(msg);
        });

        Dropzone.autoDiscover = false;
    </script>

@endpush
