@extends('layouts.app')

@section('title', '| ' . $category->title_dk )

@section('stylesheets')
    <style type="text/css">
        .hero {
            background-image: url('{{ asset('storage/thumbnail/' . $category->thumbnail) }}') !important;
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
                <h1 class="title">{{ $category->title_dk}}</h1>

                <p>{{ $category->desc_dk }}</p>
            </div>
        </div>
    </section>

    <div class="columns is-marginless is-centered">
        <div class="column is-7">
            @if (!Auth::guest() && Auth::user()->is_admin)
                <form action="{{ route('category.delete') }}" method="post">
                    {{ csrf_field() }}

                    <input type="hidden" name="identification" value="{{ $category->id }}"/>
                    <a class="button is-primary" href="{{ route('category.edit', $category->id) }}">Rediger</a>
                    <input type="submit" value="Slet" class="button is-danger"/>
                </form>
            @endif

            @forelse($posts as $post)
                <div class="card article">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content has-text-centered">
                                <p class="title article-title">{{ $post->title_dk }}</p>
                                <div class="tags has-addons level-item">
                                    <span class="tag is-rounded is-info">{{ $category->title_dk }}</span>
                                    <span class="tag is-rounded">{{ $post->created_at }}</span>
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
            @empty
                <p>Ingen Artikler under denne kategori</p>
            @endforelse
        </div>
    </div>
@endsection

@section('scripts')

@endsection
