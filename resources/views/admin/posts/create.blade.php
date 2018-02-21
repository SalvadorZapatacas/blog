<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form action="{{ route('admin.posts.store','#create') }}" method="POST">
        {{ csrf_field() }}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Título de la nueva publicacion</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <input type="text" name="title" class="form-control" placeholder="Escribe el título de la publicación" value="{{ old('title') }}" id="post-title" required autofocus autocomplete="off">
                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')

    <script>
        if(window.location.hash === '#create'){
            $('#myModal').modal('show');
        }

        $('#myModal').on('hide.bs.modal' , function(){
            window.location.hash = '#';
        });

        $('#myModal').on('shown.bs.modal' , function(){
            $('#post-title').focus();
            window.location.hash = '#create';
        });
    </script>

@endpush