@extends('layouts.mainLayout')

@section('title', 'Edit Book')

@section('content')
    <h1>Edit Book</h1>
    <div class="my-5">
        @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif
        <form action="/book-update/{{ $book->slug }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
              <div class="mb-3 row">
                <label  for="book_code" class="col-sm-2 col-form-label">Book Code</label>
                <div class="col-sm-5">
                  <input type="text" name="book_code" value="{{ $book->book_code }}" placeholder="Book Code" class="form-control" id="book_code">
                </div>
              </div>
              <div class="mb-3 row">
                <label  for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-5">
                  <input type="text" name="title" value="{{ $book->title }}" placeholder="Book Code" class="form-control" id="title">
                </div>
              </div>
              <div class="mb-3 row">
                <label  for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-5">
                  <input type="file" value="{{ $book->cover }}" name="image" placeholder="image" class="form-control" id="image">
                </div>
              </div>
              <div class="mb-3 row">
                <label  for="currentImage" class="col-sm-2 col-form-label">Current Image</label>
                <div class="col-sm-5">
                  @if ($book->cover != '')
                      <img src="{{ asset('storage/cover/'.$book->cover) }}" alt="Book Image" width="200px" height="200px">
                  @else
                     <img src="{{ asset('image/cover_notfound.png') }}" width="200px" height="200px">
                  @endif
                </div>
              </div>
              <div class="mb-3 row">
                <label  for="category" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-5">
                  <select name="categories[]" class="form-select select-multiple" id="category" multiple>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label  for="category" class="col-sm-2 col-form-label">Current Category</label>
                <div class="col-sm-5">
                    <ul>
                        @foreach ($book->categories as $category)
                            <li>{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
              </div>
              <div class="d-flex justify-content-start mt-5">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection