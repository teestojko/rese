@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/shop_representative.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
    <div class="admin_dashboard-title">Admin Dashboard</div>

    <a href="{{ route('shop_representative.edit.create') }}">Create Shop Owner</a>
    <a href="{{ route('admin.send_email') }}">Send Email to User</a>
@endsection
