@extends('layouts.app')

@section('title', '| Opret Ny Katogori')

@section('stylesheets')

@endsection

@section('content')
    <div class="columns is-marginless is-centered">
        <div class="column is-7">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Katogorier</p>
                </header>

                <div class="card-content">
                    <p>Over Katogorier</p>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($topCategory as $tcategory)
                            <tr>
                                <th>{{ $tcategory->id }}</th>
                                <td>
                                    <a href="{{ route('category.show', $tcategory->id) }}">{{ $tcategory->title_dk }}</a>
                                    | <a href="{{ route('categoryTop.edit', $tcategory->id) }}">Rediger</a> |
                                    @if (!Auth::guest() && Auth::user()->is_admin)
                                        <form action="{{ route('top.category.delete') }}" method="post">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="identification" value="{{ $tcategory->id }}"/>
                                            <input type="submit" value="Slet" class="is-link"/>
                                        </form>
                                    @endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <p>Katogorier</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <th>{{ $category->id }}</th>
                                <td><a href="{{ route('category.show', $category->id) }}">{{ $category->title_dk }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="columns is-marginless is-centered">
        <div class="column is-7">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Ny Over Katogori</p>
                </header>

                <div class="card-content">
                    @if(Session::has('success'))
                        <p class="notification is-primary">{{ Session::get('success') }}</p>
                    @endif
                    <form class="register-form" method="POST" action="{{ route('top.category.new') }}">

                        {{ csrf_field() }}

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="title_dk">Navn</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="title_dk" type="text" name="title_dk"
                                               value="{{ old('title_dk') }}"
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
                                               value="{{ old('desc_dk') }}"
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
                                        <button type="submit" class="button is-primary">Opret</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="columns is-marginless is-centered">
        <div class="column is-7">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Ny Katogori</p>
                </header>

                <div class="card-content">

                    @if(Session::has('success'))
                        <p class="notification is-primary">{{ Session::get('success') }}</p>
                    @endif
                    <form class="register-form" method="POST" action="{{ route('category.new') }}"
                          enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="title_dk">Navn</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="title_dk" type="text" name="title_dk"
                                               value="{{ old('title_dk') }}"
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
                                <label for="file-js-example" class="label">Baggrundsbillede</label>
                            </div>

                            <div class="field-body">
                                <div id="file-js-example" class="file has-name">
                                    <label class="file-label">
                                        <input class="file-input" type="file" name="thumbnail">
                                        <span class="file-cta">
                                          <span class="file-icon">
                                            <i class="fas fa-upload"></i>
                                          </span>
                                          <span class="file-label">
                                            Vælg en fil
                                          </span>
                                        </span>
                                        <span class="file-name">
                                          Ingen Fil Valgt
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="desc_dk">Beskrivelse</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                                 <textarea class="input" id="desc_dk" type="text" name="desc_dk"
                                                           placeholder="Beskriv Katogorien" required autofocus>
                                            {{ old('desc_dk') }}
                                        </textarea>
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
                            <div class="field-label">
                                <label class="top_category_id">Katogori</label>
                            </div>

                            <div class="field-body">
                                <select class="select" id="top_category_id" name="top_category_id">
                                    @foreach($topCategory as $category)
                                        <option value='{{ $category->id }}'>{{ $category->title_dk }}</option>
                                    @endforeach
                                </select>
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
                            <div class="field-body">
                                <div class="field is-grouped">
                                    <div class="control">
                                        <button type="submit" class="button is-primary">Opret</button>
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
