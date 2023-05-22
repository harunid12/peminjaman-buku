@extends('layouts.mainLayout')

@section('title', 'Book List')

@section('content')
    <form action="" method="GET">
        <div class="row">
            <div class="col-12 col-sm-6">
                <select name="category" class="form-select" id="category">
                    <option value="" style="text-align: center;">== Select Category ==</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6">
                <div class="input-group mb3">
                    <input type="text" name="title" id="title" class="form-control" aria-describedby="title" placeholder="Write Ttitle here ..."><button class="btn btn-primary" type="submit" id="title">Search</button>
                </div>
            </div>
        </div>
    </form>
    <div class="my-5">
        <div class="row">
            @foreach ($books as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card h-100">
                        <img src="{{ $item->cover !='' ? asset('storage/cover/'.$item->cover) : asset('image/cover_notfound.png') }}" alt="Book Image" draggable="false" class="card-img-top" width="200px" height="200px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->book_code }}</h5>
                            <p class="card-text">{{ $item->title }}</p>
                            <p class="card-text text-end">
                                @if ($item->status == 'in stock')
                                    <span class="badge text-bg-success">{{ $item->status }}</span>
                                @else
                                    <span class="badge text-bg-danger">{{ $item->status }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
@endsection