@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
    <h1>Edit Shop</h1>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <form method="POST" action="{{ route('shop_representative.update', $shop->id) }}">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $shop->name }}" required>
        </div>
        <div>
            <label for="image_path">Image Path</label>
            <input type="text" name="image_path" id="image_path" value="{{ $shop->image_path }}" required>
        </div>
        <div>
            <label for="prefecture">Prefecture</label>
            <input type="text" name="prefecture" id="prefecture" value="{{ $shop->prefecture->name }}" required>
        </div>
        <div>
            <label for="genre">Genre</label>
            <input type="text" name="genre" id="genre" value="{{ $shop->genre->name }}" required>
        </div>
        <div>
            <label for="detail">Detail</label>
            <textarea name="detail" id="detail" required>{{ $shop->detail }}</textarea>
        </div>
        <button type="submit">Update</button>
    </form  >
@endsection
