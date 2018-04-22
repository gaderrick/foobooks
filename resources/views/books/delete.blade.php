@extends('layouts.master')

@section('title')
    Delete {{ $book->title }}
@endsection

@push('head')
    {{-- Page specific CSS includes should be defined here; this .css file does not exist yet, but we can create it --}}
    <link href='/css/books/show.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')
    <h1>Delete {{ $book->title }}?</h1>

    <div class="book cf">
        <img src="{{ $book->cover_url  }}" class="cover" alt="Cover image for {{ $book->title  }}">
        <h2>{{ $book->title }}</h2>
        <p>By {{ $book->author }}</p>
        <p>Published in {{ $book->published_year }}</p>

        <form method='POST' action='/books/{{ $book->id }}'>
            {{ method_field('delete') }}
            {{ csrf_field() }}

            <input type='submit' value='Delete book' class='btn btn-primary'>
        </form>
    </div>


@endsection