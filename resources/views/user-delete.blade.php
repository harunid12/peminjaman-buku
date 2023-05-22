@extends('layouts.mainLayout')

@section('title', 'Bann User')


@section('content')
    <h2>Are You Sure Bann User <u>{{ $user->username }}</u> ? </h2>
    <div class="my-5">
        <h4>With Data :</h4>
        <div class="mb-3 row">
            <label  for="username" class="col-sm-1 col-form-label">Username</label>
            <div class="col-sm-3">
                <input type="text" readonly class="form-control" id="username" value="{{ $user->username }}">
            </div>
          </div>
          <div class="mb-3 row">
            <label  for="phone" class="col-sm-1 col-form-label">Phone</label>
            <div class="col-sm-3">
              <input type="text" name="phone" 
              @if ($user->phone)
                  value="{{ $user->phone }}"
              @else 
                  value="-"
              @endif 
              placeholder="Phone" class="form-control" id="phone" readonly>
            </div>
          </div>
          <div class="mb-3 row">
            <label  for="address" class="col-sm-1 col-form-label">Address</label>
            <div class="col-sm-3">
              <textarea name="address" placeholder="Book Code" class="form-control" rows="4" style="resize: none;" id="address" readonly>{{ $user->address }}</textarea>
            </div>
          </div>
          <div class="mb-3 row">
            <label  for="status" class="col-sm-1 col-form-label">Status</label>
            <div class="col-sm-3">
                <input type="text" readonly class="form-control" id="status" value="{{ $user->status }}">
            </div>
          </div>
    </div>
    <div class="my-5">
        <a href="/user-destroy/{{ $user->slug }}" class="btn btn-danger me-3">Sure</a>
        <a href="/users" class="btn btn-primary">Cancel</a>
    </div>
@endsection