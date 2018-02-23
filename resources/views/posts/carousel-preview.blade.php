<div class="gallery-photos masonry">
    @foreach($post->photos->take(4) as $photo)
        <figure class="img-responsive">
            @if($loop->iteration === 4)
                <div class="overlay">{{ $post->photos->count() }} photos</div>
            @endif

            <img src="{{ Storage::url($photo->url) }}" alt=""></figure>
    @endforeach
</div>