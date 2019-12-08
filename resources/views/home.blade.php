@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.9.1/css/OverlayScrollbars.min.css'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    @if ($setting)
        <style type="text/css">
            .hero {
                background-image: url('{{ asset('storage/thumbnail/' . $setting->thumbnail) }}') !important;
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
                height: 500px;
            }
        </style>
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
                        <div class="card article">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content has-text-centered">
                                        <p class="title article-title">{{ $post->title_dk }}</p>
                                        <div class="tags has-addons level-item">
                                            <span class="tag is-rounded is-info">{{ $category->title_dk }}</span>
                                            <span class="tag is-rounded">{{ $post->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="content article-body">
                                    <p>
                                    {!! Str::limit($post->content_dk, $limit = 400) !!}
                                    <p><a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">Læs
                                            mere...</a></p>
                                    </p>
                                </div>
                            </div>
                        </div>
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
