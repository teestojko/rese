@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
    <div class="shop_detail_page">
        <img src="{{ asset($shop->image_path) }}" alt="{{ $shop->name }}">
        <div class="shop_detail">
            <h2>{{ $shop->name }}</h2>
            <p><span>#</span> {{ $shop->prefecture }}</p>
            <p><span>#</span> {{ $shop->genre }}</p>
            <p> {{ $shop->detail }}</p>
        </div>
    </div>
@endsection
