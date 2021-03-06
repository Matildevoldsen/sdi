@extends('layouts.app')

@section('title', '| Opret Ny Artikel')

@section('stylesheets')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    <div class="columns is-marginless is-centered">
        <div class="column is-7">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">Ny Artikel</p>
                </header>

                <div class="notification is-danger" id="info" style="display: none;"></div>

                <div class="card-content">
                    <form class="register-form" method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="title_dk">Title</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="title_dk" type="text" name="title_dk"
                                               value="{{ old('title_dk') }}"
                                               placeholder="Navnet på artiklen" required autofocus>
                                    </p>

                                    @if ($errors->has('title_dk'))
                                        <p class="help is-danger">
                                            {{ $errors->first('title_dk') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="slug">Artikel Link</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="slug" type="text" name="slug" value="{{ old('slug') }}"
                                               placeholder="/post/første-dag-i-portugal" required autofocus>
                                    </p>

                                    @if ($errors->has('slug'))
                                        <p class="help is-danger">
                                            {{ $errors->first('slug') }}
                                        </p>
                                    @endif
                                </div>
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

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="thumbnail">Artikel Billede</label>
                            </div>

                            <div class="field-body">
                                <div class="file is-primary">
                                    <label class="file-label">
                                        <input id="inputGroupFile01" class="file-input custom-file-input" type="file"
                                               name="resume">
                                        <span class="file-cta">
                                                <span class="file-icon">
                                                  <i class="fas fa-upload"></i>
                                                </span>
                                                <span class="file-label">
                                                  Artikel Billede
                                                </span>
                                              </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="preview">
                            <p id="img_preview_txt"><a href="#preview" id="show_img"></a></p>

                            <img id="preview_img" class="img-fluid" src="#"/>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="meta_desc_dk">Artikel Beskrivelse (kort)</label>
                            </div>

                            <div class="field-body">
                                <div class="field">
                                    <p class="control">
                                        <input class="input" id="meta_desc_dk" type="text" name="meta_desc_dk"
                                               value="{{ old('meta_desc_dk') }}"
                                               max="160" required autofocus>
                                    </p>

                                    @if ($errors->has('meta_desc_dk'))
                                        <p class="help is-danger">
                                            {{ $errors->first('meta_desc_dk') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="category">Katogori</label>
                            </div>

                            <div class="field-body">
                                <select class="select" id="category" name="categories[]">
                                    @foreach($categories as $category)
                                        <option value='{{ $category->id }}'>{{ $category->title_dk }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="field">
                            <div id="editor">
                                <h2>Artikel Indhold</h2>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-body">
                                <div class="field is-grouped">
                                    <div class="control">
                                        <button type="submit" class="button is-primary" id="submitForm">Opret Artikel
                                        </button>
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Include the Quill library -->
    <script src="{{ asset('js/image-resize.min.js') }}"></script>
    <script src="{{ asset('js/image-drop.js') }}"></script>
    <!-- Include the Quill library -->

    <script>
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],

            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction

            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],

            ['link', 'image'],

            ['clean']
        ];

        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions,
                imageResize: {
                    displaySize: true,
                },
                imageDrop: true
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#submitForm').on('click', function (e) {
            e.preventDefault();

            var title_dk = $('#title_dk').val();
            var content_dk = $('#editor .ql-editor').html();
            var thumbnail = document.getElementById('inputGroupFile01').files[0];
            var meta_desc_dk = $('#meta_desc_dk').val();
            var slug = $('#slug').val();
            var is_private = $('#slug').val('#is_private');
            var categoryElement = document.getElementById("category");
            var selected = categoryElement.options[categoryElement.selectedIndex].value;
            var data = new FormData();

            data.append('title_dk', title_dk);
            data.append('slug', slug);
            data.append('content_dk', content_dk);
            data.append('is_private', is_private);
            data.append('thumbnail', thumbnail);
            data.append('meta_desc_dk', meta_desc_dk);
            data.append('category_id', selected);

            console.log(thumbnail)
            $.ajax({
                type: 'post',
                url: '/api/artikel/opret',
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
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview_img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName ? fileName : 'Upload File');

            $('#img_preview_txt').html('<a href="#preview" id="show_img">' + fileName + ' | Click here to preview</a>');

            readURL(this);
            $('#preview').show();
        });

        $('#preview_img').hide();
        $('#preview').hide();

        $('#img_preview_txt').click(function (e) {
            $('#preview_img').fadeToggle();
        });
    </script>
@endsection
