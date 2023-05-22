@extends('layouts.mainLayout')

@section('title', 'Delete Book')


@section('content')
    <h2>Are You Sure Delete Book <u>{{ $book->title }}</u> ? </h2>
    <div class="mt-5">
        <a href="/book-destroy/{{ $book->slug }}" class="btn btn-danger me-3">Sure</a>
        <a href="/books" class="btn btn-primary">Cancel</a>
    </div>
@endsection