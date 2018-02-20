@extends('layouts.layout')

<!-- Se puede poner así si es poco lo que vamos a poner-->
@section('meta-title' , $post->title)
@section('meta-title' , $post->excerpt)


@section('content')

    <article class="post container">

        @if($post->photos->count() === 1)
            <figure>
                <!-- First por si acaso -->
                <img src="{{ Storage::url($post->photos()->first()->url) }}" alt="" class="img-responsive">
            </figure>
        @elseif($post->photos->count() > 1)

            @include('posts.carousel')
        @elseif($post->iframe)
            <div class="video">
                {!! $post->iframe !!}
            </div>
        @else


        @endif

        <div class="content-post">
            <header class="container-flex space-between">
                <div class="date">
                    <span class="c-gris">{{ $post->published_at->format('M d') }}</span>
                </div>
                <!--
                <div class="post-category">
                    <span class="category">{{ $post->category->name }}</span>
                </div>

                -->
                <div class="post-category">
                    <a href="{{ route('categories.show', $post->category) }}">
                        <span class="category text-capitalize">{{ $post->category->name }}</span>
                    </a>
                </div>

            </header>
            <h1>{{ $post->title }}</h1>
            <div class="divider"></div>
            <div class="image-w-text">
                {!! $post->body !!}
            </div>

            <footer class="container-flex space-between">
                @include('partials.social-links', ['description' => $post->title])

                <!--
                <div class="tags container-flex">
                    @foreach($post->tags as $tag)
                        <span class="tag c-gris">#{{ $tag->name }}</span>
                    @endforeach
                </div>

                -->

                    <div class="tags container-flex">
                        @foreach($post->tags as $tag)
                            <span class="tag c-gray-1 text-capitalize">
                                    <a href="{{ route('tags.show', $tag) }}">#{{ $tag->name }}</a>
                                </span>
                        @endforeach
                    </div>
            </footer>

        </div>
    </article>

@endsection

@push('styles')
    <link rel="stylesheet" href="/css/twitter-bootstrap.css">
@endpush

@push('scripts')
    <script
            src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <script src="/js/twitter-bootstrap.js"></script>
@endpush