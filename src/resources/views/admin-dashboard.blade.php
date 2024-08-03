@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/shop-representative.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
    <div class="admin-dashboard-title">Admin Dashboard</div>

    <a href="{{ route('shop.edit.create') }}">Create Shop Representative</a>
    <a href="{{ route('admin.send-email') }}">Send Email to User</a>
@endsection
