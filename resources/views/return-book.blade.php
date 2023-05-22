@extends('layouts.mainLayout')

@section('title', 'Book Return')

@section('content')

<div class="col-12 col-md-8 col-lg-6  offset-md-2 offset-md-3">
    <h1 class="mb-5">Book Return Form</h1>
    @if (session('message'))
            <div class="alert {{ session('alert-class') }} alert-dismissible fade show">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    @endif
    <form action="book-return" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user" class="form-label">User</label>
            <select name="user_id" id="user" class="form-select select-multiple">
                <option value="">Select User</option>
                @foreach ($users as $item)
                    <option value="{{ $item->id }}">{{ $item->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="book" class="form-label">Book</label>
            <select name="book_id" id="book" class="form-select select-multiple">
                <option value="">Select book</option>
                @foreach ($books as $item)
                    <option value="{{ $item->id }}">{{ $item->book_code }}  {{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </div>
    </form>
</div>

@endsection