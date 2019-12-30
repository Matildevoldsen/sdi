@extends('layouts.app')

@section('title', '| Opret Ny Katogori')

@section('stylesheets')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    <div class="columns is-marginless is-centered">
        <div class="column is-7">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Rediger Katogori</p>
                </header>

                <div class="card-content">
                    <div class="notification is-danger" id="info" style="display: none;"></div>

                    @if(Session::has('success'))
                        <p class="notification is-primary">{{ Session::get('success') }}</p>
                    @endif
                    <form class="register-form" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        <input type="hidden" id="id" name="id" value="{{ $category->id }}">
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
                                           name="is_private"
                                            id="is_private">
                                    Skal den være privat?
                                </label>
                            </div>
                        </div>

                        <div class="field">
                            <div id="editor">
                                {!! $category->desc_dk !!}
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
                                        <input id="inputGroupFile01" class="file-input" type="file" name="thumbnail">
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
                                        <button type="submit" class="button is-primary" id="submitForm">Gem
                                        </button>
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
            <!-- Include the Quill library -->
                <!-- Include the Quill library -->
                <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

                <script type="text/javascript">
                    var quill = new Quill('#editor', {
                        theme: 'snow'
                    });

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });


                    $('#submitForm').on('click', function (e) {
                        e.preventDefault();

                        var title_dk = $('#title_dk').val();
                        var id = $('#id').val();
                        var content_dk = $('#editor .ql-editor').html();
                        var thumbnail = document.getElementById('inputGroupFile01').files[0];
                        var is_private = $('#slug').val('#is_private');
                        var categoryElement = document.getElementById("top_category_id");
                        var selected = categoryElement.options[categoryElement.selectedIndex].value;
                        var data = new FormData();

                        data.append('title_dk', title_dk);
                        data.append('desc_dk', content_dk);
                        data.append('id', id);
                        data.append('is_private', is_private);
                        data.append('thumbnail', thumbnail);
                        data.append('top_category_id', selected);

                        $.ajax({
                            type: 'post',
                            url: '/api/katogori/rediger',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: data,
                            success: function (data) {
                                if (data.data.to) {
                                    const to = data.data.to;
                                    window.location.replace(to);
                                }
                            },
                            error: function (jqXhr, json, errorThrown) {
                                $('#info').hide();
                                $('#info').show();
                                var errors = jqXhr.responseJSON.errors;
                                var errorsHtml = '';
                                $.each(errors, function (key, value) {
                                    errorsHtml += '<li>' + value[0] + '</li>';
                                });
                                $('#info').html(errorsHtml, "Error " + jqXhr.status + ': ' + errorThrown);
                            }
                        });
                    });
                </script>
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
