@extends('layouts.app')

@section('title', '| ' . $category->title_dk )

@section('stylesheets')

@endsection

@section('content')
    <div class="columns is-marginless is-centered">
        <div class="column is-7">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Katogori - {{$category->title_dk}}</p>
                </header>

                <div class="card-content">
                    <p><b>Over Katogori</b>: {{ $category->topCategory->title_dk }}</p>
                    <p><b>Navn</b>: {{ $category->title_dk }}</p>
                    <p><b>Beskrivelse</b>: {{ $category->title_dk }}</p>

                    @if (!Auth::guest() && Auth::user()->is_admin)
                        <form action="{{ route('category.delete') }}" method="post">
                            {{ csrf_field() }}

                            <input type="hidden" name="identification" value="{{ $category->id }}"/>
                            <br/><input type="submit" value="Slet" class="button is-danger"/>
                        </form>
                    @endif
                </div>
            </div>
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
