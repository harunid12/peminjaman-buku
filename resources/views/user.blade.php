@extends('layouts.mainLayout')

@section('title', 'Users')

@section('content')

    <h1> Users List</h1>
    <div class="mt-3">
        @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif
    </div>

    <div class="mt-5 d-flex justify-content-end">
        <a href="/user-banned" class="btn btn-secondary me-3">View Banned Users</a>
        <a href="/registered-users" class="btn btn-primary">New Registered Users</a>
    </div>
    <div class="my-5">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->username }}</td>
                        <td>
                            @if ($item->phone)
                                {{ $item->phone }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="/user-detail/{{ $item->slug }}" class="btn btn-primary">Detail</a>
                            <a href="/user-ban/{{ $item->slug }}" class="btn btn-danger">Banned</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection