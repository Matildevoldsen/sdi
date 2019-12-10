@extends('layouts.app')

@section('title', '| ' . $category->title_dk )

@section('stylesheets')
    <meta name="description" content="{{ Str::limit($category->desc_dk, $limit = 160) }}"/>
    <style type="text/css">.hero {background-image: url('{{ asset('storage/thumbnail/' . $category->thumbnail) }}') !important;background-position: center;background-size: cover;background-repeat: no-repeat;height: 500px;}</style>
@endsection

@section('content')
    <section class="hero is-info is-medium is-bold">
        <div class="hero-body">
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
                                <p class="title article-title">{{ $category->title_dk }}</p>
                            </div>
                        </div>
                        <div class="content article-body">
                            <p>{!! nl2br(e($category->desc_dk)) !!}</p>
                            @if (!Auth::guest() && Auth::user()->is_admin)
                                <form action="{{ route('category.delete') }}" method="post">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="identification" value="{{ $category->id }}"/>
                                    <a class="button is-primary" href="{{ route('category.edit', $category->id) }}">Rediger</a>
                                    <input type="submit" value="Slet" class="button is-danger"/>
                                </form>
                            @endif
                            <hr />
                            @forelse($posts as $post)

                                <p class="title article-title has-text-centered">{{ $post->title_dk }}</p>
                                <div class="tags has-addons level-item">
                                    <span class="tag is-rounded is-info">{{ $category->title_dk }}</span>
                                    <span class="tag is-rounded">{{ $post->created_at->diffForHumans() }}</span>
                                </div>

                                <p>
                                {!! Str::limit($post->content_dk, $limit = 400) !!}
                                <p><a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">Læs
                                        mere...</a></p>
                                </p>
                        </div>
                    </div>
                    @empty
                        <p>Ingen Artikler under denne kategori</p>
                    @endforelse
                </div>
            </div>
    </div>
    </div>
    </section>
    </div>
@endsection

@section('scripts')

@endsection
