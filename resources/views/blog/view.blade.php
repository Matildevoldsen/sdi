@extends('layouts.app')
@section('title', '| ' . $post->title_dk)
@section('stylesheets')
    <meta property="og:type" content="article" />
    <meta property="og:image:width" content="450"/>
    <meta property="og:image:height" content="298"/>
    <meta property="og:description" content="{{ strip_tags(Str::limit($post->content_dk, $limit = 160)) }}" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:image" content="{{ asset('storage/thumbnail/post/' . $post->thumbnail) }}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.9.1/css/OverlayScrollbars.min.css'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <meta name="description" content="{{ strip_tags(Str::limit($post->content_dk, $limit = 160)) }}"/>
    <style type="text/css">
        .hero {
            background-image: url('{{ asset('storage/thumbnail/post/' . $post->thumbnail) }}') !important;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            height: 500px;
        }
    </style>
@endsection

@section('content')
    <section class="hero is-info is-medium is-bold">
        <div class="hero-body">
            <div class="container has-text-centered">

            </div>
        </div>
    </section>


    <div class="container">
        <!-- START ARTICLE FEED -->
        <section class="articles">
            <div class="column is-8 is-offset-2">
                <div class="card article">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content has-text-centered">
                                <p class="title article-title">{{ $post->title_dk }}</p>
                                <div class="tags has-addons level-item">
                                    <span class="tag is-rounded is-info">
                                        @foreach ($post->category as $category)
                                            {{ $category->title_dk }}
                                        @endforeach
                                    </span>
                                    <span class="tag is-rounded">{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="content article-body">
                            <p>{!! $post->content_dk !!}</p>
                            @if (!Auth::guest() && Auth::user()->is_admin == 1)
                                <a href="{{ route('post.destroy', $post->id) }}" class="button is-danger">Slet
                                    Artikel</a>  <a href="{{ route('post.edit', $post->id) }}" class="button is-primary">Rediger Artikel</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- END ARTICLE FEED -->
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.9.1/js/OverlayScrollbars.min.js'></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            //The first argument are the elements to which the plugin shall be initialized
            //The second argument has to be at least a empty object or a object with your desired options
            OverlayScrollbars(document.querySelectorAll("body"), {});
        });
    </script>
@endsection
