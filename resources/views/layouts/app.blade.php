<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <link href="lib/noty.css" rel="stylesheet">
    <link href="lib/themes/metroui.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-154778818-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-154778818-1');
    </script>

    <title>{{ config('app.name', 'Love Of Portugal') }} @yield('title')</title>

    <!-- Styles -->
    @yield('stylesheets')
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar has-shadow">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ url('/') }}" class="navbar-item">{{ config('app.name', 'Love Of Portugal') }}</a>

                <div class="navbar-burger burger" data-target="navMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="navbar-menu" id="navMenu">
                <div class="navbar-start">
                    <a class="navbar-item" href="{{ route('home') }}">
                        Forside
                    </a>

                    <a class="navbar-item" href="{{ route('about') }}">
                        Om Mig
                    </a>
                    @if ($topCategories)
                        @foreach ($topCategories as $topCategory)
                            <div class="navbar-item has-dropdown is-hoverable">
                                <a class="navbar-link" href="#">{{ $topCategory->title_dk }}</a>

                                <div class="navbar-dropdown">

                                    @foreach ($categories as $category)
                                        @if ($category->top_category_id == $topCategory->id)
                                            <a class="navbar-item" href="{{ route('category.show', $category->id) }}">
                                                {{ $category->title_dk }}
                                            </a>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <form action="{{ route('search') }}" method="get">
                            <div class="field has-addons">
                                <div class="control">
                                    <input name="q" @if (isset($query) && $query) value="{{ $query }}" @endif class="input" type="text">
                                </div>
                                <div class="control">
                                    <a class="button is-info">
                                        Søg
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if (!Auth::guest())
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link" href="#">{{ Auth::user()->name }}</a>

                            <div class="navbar-dropdown">
                                <a class="navbar-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    @endif

                    @if (!Auth::guest() && Auth::user()->is_admin == 1)
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link" href="#">Admin</a>

                            <div class="navbar-dropdown">
                                <a class="navbar-item" href="{{ route('post.new') }}">
                                    Ny Artikel
                                </a>
                                <a class="navbar-item" href="{{ route('category.showForm') }}">
                                    Ny Katogori
                                </a>

                                <hr class="dropdown-divider">

                                <a class="navbar-item" href="{{ route('about.edit') }}">
                                    Rediger Om mig
                                </a>
                                <a class="navbar-item" href="{{ route('settings.edit') }}">
                                    Side Indstillinger
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
</div>
<!-- Scripts -->
<script src="lib/noty.js" type="text/javascript"></script>
@if(Session::has('error'))
    <script type="text/javascript">
        new Noty({
            type: 'error',
            theme: 'metroui',
            layout: 'topRight',
            text: '{{ Session::get('error') }}'
        }).show();
    </script>
@endif
@yield('scripts')
<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
