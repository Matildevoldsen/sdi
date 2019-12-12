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
                    <form class="register-form" method="POST" enctype="multipart/form-data" action="{{ route('category.update', $category->id) }}">

                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $category->id }}">
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
                                <label class="desc_dk">Beskrivelse</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <textarea class="input" id="desc_dk" type="text" name="desc_dk" placeholder="Beskriv Katogorien" required autofocus>{!! nl2br($category->desc_dk) !!}</textarea>
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
                                    @foreach($topCategories as $category)
                                        <option value='{{ $category->id }}'>{{ $category->title_dk }}</option>
                                    @endforeach
                                </select>
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
            <script>
                const fileInput = document.querySelector('#file-js-example input[type=file]');
                fileInput.onchange = () => {
                    if (fileInput.files.length > 0) {
                        const fileName = document.querySelector('#file-js-example .file-name');
                        fileName.textContent = fileInput.files[0].name;
                    }
                }
            </script>
        @endsection
