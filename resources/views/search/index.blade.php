@extends('layouts.app')

@section('title', '| Søg')

@section('stylesheets')

@endsection

@section('content')
    <div class="container">
        <div class="section">
            <div class="column is-8 is-offset-2">
                <div class="box">
                    <form action="{{ route('search') }}" method="get">
                        <div class="field is-grouped">
                            <p class="control is-expanded" style="width: 100%;">
                                <input name="q" class="input" type="text" value="{{ $query }}">
                            </p>
                            <p class="control">
                                <a class="button is-info">
                                    Søg
                                </a>
                            </p>
                        </div>
                    </form>
                    <p>Du søgte på <b>{{ $query }}</b>. Der er <b>{{ $posts->count() }}</b> artikler der matcher
                        <b>{{ $query }}</b> og <b>{{ $searchCategories->count() }}</b> katogorier.</p>
                </div>
            </div>
        </div>
        <!-- START ARTICLE FEED -->
        @if ($posts->count() > 0)
            <section>
                <div class="column is-8 is-offset-2">
                    <h2 class="title has-text-centered" style="margin-top: 5px;">Artikler</h2>
                    <!-- START ARTICLE -->
                    @foreach ($posts as $post)
                        @foreach ($post->category as $category)
                            @if ($post->is_private == 0  && Auth::guest() || !Auth::guest() && Auth::user()->is_admin == 0)
                                @if ($category->is_private == 0)
                                    <div class="card" style="margin-bottom: 5rem;">
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
                                                {!! Str::limit($post->content_dk, $limit = 400) !!}
                                                <p>
                                                    <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">Læs
                                                        mere...</a></p>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @elseif (!Auth::guest() && Auth::user()->is_admin == 1)
                                <div class="card" style="margin-bottom: 5rem;">
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
                                            {!! Str::limit($post->content_dk, $limit = 400) !!}
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
        @endif
    <!-- END ARTICLE FEED -->
        <section>
            <div class="column is-8 is-offset-2">
                <h2 class="title has-text-centered" style="margin-top: 5px;">Katogorier</h2>
                <!-- START ARTICLE -->
                @foreach ($searchCategories as $category)
                    @if ($category->is_private == 0  && Auth::guest() || !Auth::guest() && Auth::user()->is_admin == 0)
                        @if ($category->is_private == 0)
                            <div class="card" style="margin-bottom: 5rem;">
                                <div class="card-content">
                                    <div class="media">
                                        <div class="media-content has-text-centered">
                                            <p class="title article-title"><a class="title-link"
                                                                              href="{{ route('category.show', ['id' => $category->id]) }}">{{ $category->title_dk }}</a>
                                            </p>
                                            <div class="tags has-addons level-item">
                                                    <span class="tag is-rounded">
                                                {{ $category->created_at->diffForHumans() }}
                                                        @if ($category->created_at->diffForHumans() !== $category->updated_at->diffForHumans())
                                                            sidst opdateret {{ $category->updated_at->diffForHumans() }}
                                                        @endif
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content article-body">
                                        <p>
                                        {!! Str::limit($category->desc_dk, $limit = 400) !!}
                                        <p>
                                            <a href="{{ route('category.show', ['id' => $category->id]) }}">Læs
                                                mere...</a></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @elseif (!Auth::guest() && Auth::user()->is_admin == 1)
                        <div class="card" style="margin-bottom: 5rem;">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content has-text-centered">
                                        <p class="title article-title"><a class="title-link"
                                                                          href="{{ route('category.show', ['id' => $category->id]) }}">{{ $category->title_dk }}</a>
                                        </p>
                                        <div class="tags has-addons level-item">
                                                    <span class="tag is-rounded">
                                                {{ $category->created_at->diffForHumans() }}
                                                        @if ($category->created_at->diffForHumans() !== $category->updated_at->diffForHumans())
                                                            sidst opdateret {{ $category->updated_at->diffForHumans() }}
                                                        @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="content article-body">
                                    <p>
                                    {!! Str::limit($category->desc_dk, $limit = 400) !!}
                                    <p>
                                        <a href="{{ route('category.show', ['id' => $category->id]) }}">Læs
                                            mere...</a></p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </section>
    </div>
@endsection
