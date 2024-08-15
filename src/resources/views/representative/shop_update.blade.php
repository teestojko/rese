@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/representative/shop_update.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
<div class="content">
    <div class="detail">
        <div class="top">
            店舗情報変更
        </div>
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <form class="shop_update_form" method="POST" action="{{ route('shop_representative.update', $shop->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="image_path_content">
                <div class="image_path_top">
                    Image_Path
                </div>
                <label class="image_path_label" for="image_path">
                    画像を選択
                </label>
                    <input type="file" name="image_path" id="image_path" required>
            </div>
            <div class="name_content">
                <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ $shop->name }}" required>
            </div>
            <div class="prefecture_content">
                <label for="prefecture">Prefecture</label>
                <select name="prefecture_id" id="prefecture" required>
                    @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}" {{ $shop->prefecture_id == $prefecture->id ? 'selected' : '' }}>
                            {{ $prefecture->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="genre_content">
                <label for="genre">Genre</label>
                <select name="genre_id" id="genre" required>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $shop->genre_id == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="detail_content">
                <label class="detail_label" for="detail">Detail</label>
                <textarea name="detail" id="detail" required>{{ $shop->detail }}</textarea>
            </div>
            @error('image_path')
                {{ $message }}
            @enderror
            @error('detail')
                {{ $message }}
            @enderror
            <div class="submit_content">
                <button class="submit" type="submit">更新する</button>
            </div>
        </form>
        <div class="dashboard_button_content">
            <a class="dashboard_button" href="{{ route('shop_representative.dashboard')}}">
                戻る
            </a>
        </div>
    </div>
</div>
@endsection
