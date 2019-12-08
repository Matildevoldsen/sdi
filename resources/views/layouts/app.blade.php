<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <link href="/lib/noty.css" rel="stylesheet">
    <link href="/lib/themes/metroui.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Love Of Portugal') }} @yield('title')</title>

    <!-- Styles -->
    @yield('stylesheets')
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script src="/lib/noty.js" type="text/javascript"></script>

    <script type="text/javascript">
        new Noty({
            theme: 'metroui',
            type: 'info',
            layout: 'topRight',
            text: 'dd'
        }).show();
    </script>
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
                    @if (!Auth::guest())
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link" href="#">{{ Auth::user()->name }}</a>

                            <div class="navbar-dropdown">
                                <a class="navbar-item" href="{{ route('post.new') }}">
                                    Ny Artikel
                                </a>
                                <a class="navbar-item" href="{{ route('category.showForm') }}">
                                    Ny Katogori
                                </a>
                                <a class="navbar-item" href="{{ route('about.edit') }}">
                                    Rediger Om mig
                                </a>
                                <a class="navbar-item" href="{{ route('settings.edit') }}">
                                    Side Indstillinger
                                </a>
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
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
</div>
<!-- Scripts -->
@yield('scripts')
<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>

</body>
</html>
