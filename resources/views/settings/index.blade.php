@extends('layouts.app')

@section('title', '| Side Indstillinger')

@section('stylesheets')

@endsection

@section('content')
    <div class="columns is-marginless is-centered">
        <div class="column is-7">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Side Indstillinger</p>
                </header>

                <div class="card-content">
                    <form class="login-form" method="POST" action="{{ route('settings.update') }}">
                        {{ csrf_field() }}

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Velkommen Tekst på dansk (Forside)</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="welcome_dk" type="text" name="welcome_dk"
                                               value="{{ old('welcome_dk') }}" required autofocus>
                                    </p>

                                    @if ($errors->has('welcome_dk'))
                                        <p class="help is-danger">
                                            {{ $errors->first('welcome_dk') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Velkommen Tekst på engelsk (Forside)</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="welcome_en" type="text" name="welcome_en"
                                               value="{{ old('welcome_en') }}" required autofocus>
                                    </p>

                                    @if ($errors->has('welcome_en'))
                                        <p class="help is-danger">
                                            {{ $errors->first('welcome_en') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">Generel Beskrivelse på søge maskiner</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="main_site_desc" type="text" name="main_site_desc"
                                               value="{{ old('main_site_desc') }}" required autofocus>
                                    </p>

                                    @if ($errors->has('main_site_desc'))
                                        <p class="help is-danger">
                                            {{ $errors->first('main_site_desc') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label"></div>

                            <div class="field-body">
                                <div class="field is-grouped">
                                    <div class="control">
                                        <button type="submit" class="button is-primary">Opdater</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p>Clear Cache vil nogle gange kunne fixe små fejl som link til artikel der ikke virker. Brug kun denne knap hvis link ikke virker</p>
                        <div class="field is-horizontal">
                            <div class="field-body">
                                <div class="field is-grouped">
                                    <div class="control">
                                        <button type="submit" class="button is-warning">Clear Cache</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
