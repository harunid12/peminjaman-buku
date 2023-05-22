@extends('layouts.mainLayout')

@section('title', 'Rent Log')

@section('content')
<h1> Rent Logs List</h1>
<div class="my-5">
    <x-rent-log-table :rentlog='$rentlogs' />
</div>
@endsection