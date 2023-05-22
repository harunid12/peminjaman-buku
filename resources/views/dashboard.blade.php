@extends('layouts.mainLayout')

@section('title', 'Dashboard')


@section('content')

    <h1>Welcome, {{ Auth::user()->username }}</h1>
    <div class="row my-5">
        <div class="col-lg-4">
            <div class="card-data book border rounded">
                <div class="row">
                    <div class="col-6"><i class="bi bi-journal-bookmark"></i></div>
                    <div class="col-6 d-flex justify-content-center flex-column align-items-end">
                        <div class="card-desc">Books</div>
                        <div class="card-count">{{ $book_count }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-data category border rounded">
                <div class="row">
                    <div class="col-6"><i class="bi bi-list-task"></i></div>
                    <div class="col-6 d-flex justify-content-center flex-column align-items-end">
                        <div class="card-desc">Category</div>
                        <div class="card-count">{{ $category_count }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-data users border rounded">
                <div class="row">
                    <div class="col-6"><i class="bi bi-people-fill"></i></div>
                    <div class="col-6 d-flex justify-content-center flex-column align-items-end">
                        <div class="card-desc">Users</div>
                        <div class="card-count">{{ $user_count }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-5">
        <x-rent-log-table :rentlog='$rentlogs' />
    </div>
@endsection