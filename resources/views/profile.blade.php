@extends('layouts.mainLayout')

@section('title', 'Profile')

@section('content')
    <h1>Hello, {{ Auth::user()->username }}</h1>
    <div class="mt-5">
        <h2>Your Rent Log</h2>
        <x-rent-log-table :rentlog='$rentlogs' />
      </div>
@endsection