@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
    <h1>shop_owner Dashboard</h1>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <!-- 以下に既存のショップリストを表示し、編集リンクを追加 -->
    @if ($shop)
        <div>
            <h2>{{ $shop->name }}</h2>
            <a href="{{ route('shop_representative.edit', $shop->id) }}">Edit Shop</a>
        </div>
    @else
        <p>No shop information available.</p>
    @endif

    <a href="{{ route('shop_representative.reservations.list') }}">View Reservations</a>
@endsection
