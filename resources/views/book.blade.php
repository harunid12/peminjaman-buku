@extends('layouts.mainLayout')

@section('title', 'Books')

@section('content')

    <h1> Books List</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="/book-deleted" class="btn btn-secondary me-2"><i class="bi bi-eyeglasses me-1"></i> View Deleted Data</a>
        <a href="/book-add" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Book</a>
    </div>

    <div class="mt-3">
        @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif
    </div>
    <div class="my-5">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Book Code</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->book_code }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            @foreach ($item->categories as $category)
                                <ul>
                                    <li>{{ $category->name }}</li>
                                </ul>
                            @endforeach
                        </td>
                        <td>
                            @if ($item->status == 'in stock')
                                <span class="badge text-bg-success">In Stock</span>
                            @else
                                <span class="badge text-bg-danger">not available</span>
                            @endif
                        </td>
                        <td>
                            <a href="/book-edit/{{ $item->slug }}" class="btn btn-primary">edit</a>
                            <a href="/book-delete/{{ $item->slug }}" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection