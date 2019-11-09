@extends('layouts.app')

@section('title', '| ' . $category->title_dk )

@section('stylesheets')

@endsection

@section('content')
<div class="columns is-marginless is-centered">
        <div class="column is-7">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">Katogori - {{$category->title_dk}}</p>
                    </header>

                    <div class="card-content">
                        <p><b>Navn</b>: {{ $category->title_dk }}</p>
                        <p><b>Beskrivelse</b>: {{ $category->desc_dk }}</p>

                        @if (!Auth::guest() && Auth::user()->is_admin)
                        <form action="{{ route('category.delete') }}" method="post">
                                {{ csrf_field() }}

                            <input type="hidden" name="identification" value="{{ $category->id }}"/>
                            <br /><input type="submit" value="Slet" class="button is-danger"/>
                        </form>
                        @endif
                    </div>
                </div>
        </div>
</div>
@endsection

@section('scripts')

@endsection
