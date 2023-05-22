@extends('layouts.mainLayout')

@section('title', 'Delete Category')


@section('content')
    <h2>Are You Sure Delete Category <u>{{ $category->name }}</u> ? </h2>
    <div class="mt-5">
        <a href="/category-destroy/{{ $category->slug }}" class="btn btn-danger me-3">Sure</a>
        <a href="/categories" class="btn btn-primary">Cancel</a>
    </div>
@endsection