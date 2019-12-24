@extends('layouts.app')

@section('title', '| Opret Ny Katogori')

@section('stylesheets')

@endsection

@section('content')
    <div class="columns is-marginless is-centered">
        <div class="column is-7">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Rediger Katogori</p>
                </header>

                <div class="card-content">

                    @if(Session::has('success'))
                        <p class="notification is-primary">{{ Session::get('success') }}</p>
                    @endif
                    <form class="register-form" method="POST" enctype="multipart/form-data" action="{{ route('categoryTop.update', $category->id) }}">

                        {{ csrf_field() }}

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="title_dk">Navn</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="title_dk" type="text" name="title_dk"
                                               value="{{ $category->title_dk }}"
                                               placeholder="Katogori" required autofocus>
                                    </p>
                                </div>
                                @if ($errors->has('title_dk'))
                                    <p class="help is-danger">
                                        {{ $errors->first('title_dk') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                Offentligør
                            </div>
                            <div class="field-body">
                                <label class="checkbox">
                                    <input type="checkbox"
                                           name="is_private">
                                    Skal den være privat?
                                </label>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="desc_dk">Beskrivelse</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="desc_dk" type="text" name="desc_dk"
                                               value="{{ $category->desc_dk }}"
                                               placeholder="Beskriv Katogorien" required autofocus>
                                    </p>
                                </div>
                                @if ($errors->has('desc_dk'))
                                    <p class="help is-danger">
                                        {{ $errors->first('desc_dk') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-body">
                                <div class="field is-grouped">
                                    <div class="control">
                                        <button type="submit" class="button is-primary">Gem</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection

        @section('scripts')

@endsection
