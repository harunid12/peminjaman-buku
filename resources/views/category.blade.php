@extends('layouts.mainLayout')

@section('title', 'Category')


@section('content')
    <h1> Category List</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="category-deleted" class="btn btn-secondary me-2"><i class="bi bi-eyeglasses me-1"></i> View Deleted Data</a>
        <a href="category-add" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Data</a>
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
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="category-edit/{{ $item->slug }}" class="btn btn-primary">edit</a>
                            <a href="category-delete/{{ $item->slug }}" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection