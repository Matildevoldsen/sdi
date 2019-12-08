@extends('layouts.app')

@section('title', '| Opret Ny Katogori')

@section('stylesheets')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    <div class="columns is-marginless is-centered">
        <div class="column is-7">
            <div class="card">
                <div class="notification is-danger" id="info" style="display: none;"></div>
                <header class="card-header">
                    <p class="card-header-title">Rediger Om Mig</p>
                </header>

                <div class="card-content">

                    @if(Session::has('success'))
                        <p class="notification is-primary">{{ Session::get('success') }}</p>
                    @endif
                    <form method="POST" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label for="file-js-example" class="label">Baggrundsbillede</label>
                            </div>

                            <div class="field-body">
                                <input type="file" class="file" id="bg" name="bg">
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
                                        <button type="submit" id="submitForm" class="button is-primary">Gem</button>
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script type="text/javascript" src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

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

                    var desc = $('#editor .ql-editor').html();
                    var bg = document.getElementById('bg').files[0];
                    var data = new FormData();

                    data.append('desc', desc);
                    data.append('bg', bg);

                    $.ajax({
                        type: 'post',
                        url: '/api/om-mig/rediger',
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
@endsection

