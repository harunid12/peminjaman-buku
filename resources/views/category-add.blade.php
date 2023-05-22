@extends('layouts.mainLayout')

@section('title', 'Add Category')

@section('content')
    <h1>Add New Category</h1>
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
        <form action="category-save" method="POST">
            @csrf
              <div class="mb-3 row">
                <label  for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-5">
                  <input type="text" name="name" placeholder="Category Name" class="form-control" id="name">
                  <div class="d-flex justify-content-end mt-3">
                      <button class="btn btn-success" type="submit">Save</button>
                  </div>
                </div>
              </div>
        </form>
    </div>
@endsection