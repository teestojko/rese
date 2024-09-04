@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/shop_edit.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <div class="main">
        <div class="main_content">
            <div class="title">
                店舗代表者作成画面
            </div>
            <form class="shop_edit_form" method="POST" action="{{ route('admin.store') }}">
            @csrf
                <div class="name_culumn">
                    <div class="comment">
                        名前
                    </div>
                    <div class="input">
                        <label for="name"></label>
                        <input type="text" name="name" id="name" required>
                    </div>
                </div>
                <div class="email_culumn">
                    <div class="comment">
                        Email
                    </div>
                    <div class="input">
                        <label for="email"></label>
                        <input type="email" name="email" id="email" required>
                    </div>
                </div>
                <div class="password_culumn">
                    <div class="comment">
                        パスワード
                    </div>
                    <div class="input">
                        <label for="password"></label>
                        <input type="password" name="password" id="password" required>
                    </div>
                </div>
                <div class="confirm_culumn">
                    <div class="comment">
                        確認パスワード
                    </div>
                    <div class="input">
                        <label for="password_confirmation"></label>
                        <input type="password" name="password_confirmation" id="password_confirm" required>
                    </div>
                </div>
                <div class="shop_culumn">
                    <div class="comment">
                        Shop
                    </div>
                    <div class="input">
                        <label for="shop_id"></label>
                        <select name="shop_id" id="shop_id" required>
                            @foreach ($shops as $shop)
                                <option value="{{ $shop->id }}">
                                    {{ $shop->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="button">
                    <button class="submit" type="submit">
                        作成する
                    </button>
                </div>
            </form>
            <div class="dashboard_button_content">
                <a class="dashboard_button" href="{{ route('admin.dashboard')}}">
                    戻る
                </a>
            </div>
            @if (session('success'))
                <p class="success_message">
                    {{ session('success') }}
                </p>
            @endif
        </div>
    </div>
@endsection
