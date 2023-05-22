@extends('layouts.mainLayout')

@section('title', 'Deleted Books')


@section('content')
    <h1> Deleted Books List</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="/books" class="btn btn-danger"> Back</a>
    </div>

    <div class="my-5">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Book Code</th>
                    <th>Title</th>
                    <th>Category</th>
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
                            <a href="/book-restore/{{ $item->slug }}" class="btn btn-success">Restore</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection