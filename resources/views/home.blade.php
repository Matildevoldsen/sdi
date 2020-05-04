@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.9.1/css/OverlayScrollbars.min.css'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    @if ($setting)
        <meta property="og:url" content="{{ Request::fullUrl() }}" />
        <meta property="og:image:width" content="450"/>
        <meta property="og:image:height" content="298"/>
        <meta property="og:image" content="{{ asset('storage/thumbnail/' . $setting->thumbnail) }}"/>
        <style type="text/css">
            .hero {
                background-image: url('{{ asset('storage/thumbnail/' . $setting->thumbnail) }}') !important;
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
                height: 500px;
            }
        </style>

        <meta name="description" content="{{ strip_tags($setting->main_site_desc) }}"/>
    @endif
@endsection

@section('content')
    <section class="hero is-info is-medium is-bold">
        <div class="hero-body">
            <div class="container has-text-centered">
                @if ($setting)
                    <h1 class="title">{{ $setting->welcome_dk }}</h1>
                @endif
            </div>
        </div>
    </section>


    <div class="container">
        <!-- START ARTICLE FEED -->
        <section class="articles">
            <div class="column is-8 is-offset-2">
                <!-- START ARTICLE -->
                @foreach ($posts as $post)
                    @foreach ($post->category as $category)
                        @if ($post->is_private == 0  && Auth::guest() || !Auth::guest() && Auth::user()->is_admin == 0)
                            @if ($category->is_private == 0)
                                <div class="card article">
                                    <div class="card-content">
                                        <div class="media">
                                            <div class="media-content has-text-centered">
                                                <p class="title article-title"><a class="title-link"
                                                                                  href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title_dk }}</a>
                                                </p>
                                                <div class="tags has-addons level-item">
                                            <span class="tag is-rounded is-info"><a class="category-link"
                                                                                    href="{{ route('category.show', $category->id) }}">{{ $category->title_dk }}</a></span>
                                                    <span class="tag is-rounded">
                                                {{ $post->created_at->diffForHumans() }}
                                                        @if ($post->created_at->diffForHumans() !== $post->updated_at->diffForHumans())
                                                            sidst opdateret {{ $post->updated_at->diffForHumans() }}
                                                        @endif
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content article-body">
                                            <p>
                                            {!! strip_tags(Str::limit($post->content_dk, $limit = 400), '<p><b><strong><i><ul><li>') !!}
                                            <p>
                                                <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">Læs
                                                    mere...</a></p>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @elseif (!Auth::guest() && Auth::user()->is_admin == 1)
                            <div class="card article">
                                <div class="card-content">
                                    <div class="media">
                                        <div class="media-content has-text-centered">
                                            <p class="title article-title"><a class="title-link"
                                                                              href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title_dk }}</a>
                                            </p>
                                            <div class="tags has-addons level-item">
                                            <span class="tag is-rounded is-info"><a class="category-link"
                                                                                    href="{{ route('category.show', $category->id) }}">{{ $category->title_dk }}</a></span>
                                                <span class="tag is-rounded">
                                                {{ $post->created_at->diffForHumans() }}
                                                    @if ($post->created_at->diffForHumans() !== $post->updated_at->diffForHumans())
                                                        sidst opdateret {{ $post->updated_at->diffForHumans() }}
                                                    @endif
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content article-body">
                                        <p>
                                        {!! strip_tags(Str::limit($post->content_dk, $limit = 400),  '<p><b><strong><i><ul><li>') !!}
                                        <p>
                                            <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">Læs
                                                mere...</a></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>

        </section>
        <!-- END ARTICLE FEED -->
    </div>
    <script async type="text/javascript" src="../js/bulma.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.9.1/js/OverlayScrollbars.min.js'></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            //The first argument are the elements to which the plugin shall be initialized
            //The second argument has to be at least a empty object or a object with your desired options
            OverlayScrollbars(document.querySelectorAll("body"), {});
        });
    </script>
@endsection
