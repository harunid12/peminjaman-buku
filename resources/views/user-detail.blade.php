@extends('layouts.mainLayout')

@section('title', 'Detail User')

@section('content')
    <h1>Detail User</h1>
    <div class="mt-5 d-flex justify-content-end">
        @if ($user->status == 'active')
            
        @else
            <a href="/user-approve/{{ $user->slug }}" class="btn btn-secondary me-2"><i class="bi bi-eyeglasses me-1"></i> Approve users</a>
        @endif
    </div>
    <div class="mt-3">
        @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif
    </div>
    <div class="row">
      <div class="col-5">
        <div class="my-5">
          <div class="mb-3 row">
            <label  for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-8">
                <input type="text" readonly class="form-control" id="username" value="{{ $user->username }}">
            </div>
          </div>
          <div class="mb-3 row">
            <label  for="phone" class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-8">
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
            <label  for="address" class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-8">
              <textarea name="address" placeholder="Book Code" class="form-control" rows="4" style="resize: none;" id="address" readonly>{{ $user->address }}</textarea>
            </div>
          </div>
          <div class="mb-3 row">
            <label  for="status" class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-8">
                <input type="text" readonly class="form-control" id="status" value="{{ $user->status }}">
            </div>
          </div>
        </div>
      </div>
      <div class="col-7">
        <h2>User Rent Log</h2>
        <x-rent-log-table :rentlog='$rentlogs' />
      </div>
    </div>
@endsection