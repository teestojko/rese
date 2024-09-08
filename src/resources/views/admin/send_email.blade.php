@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/send_email.css') }}">
@endsection

@section('content')
<div class="main">
    <div class="main_content">
        <div class="title">
            全てのユーザーにメール送信
        </div>
        <div class="sub_content">
            <form class="email_form" action="{{ route('admin.send_email') }}" method="POST">
            @csrf
                <div class="column">
                    <div class="comment">
                        件名
                    </div>
                    <div class="column_detail">
                        <label for="subject" ></label>
                        <input type="text" name="subject" id="subject" placeholder="件名を入力してください">
                    </div>
                </div>
                @error('subject')
                    <div class="alert_danger_comment">
                        {{ $message }}
                    </div>
                @enderror
                <div class="column">
                    <div class="comment">
                        メッセージ
                    </div>
                    <div class="column_detail2">
                        <label class="message" for="message"></label>
                        <textarea name="message" id="message" rows="5"></textarea>
                    </div>
                </div>
                @error('message')
                    <div class="alert_danger_comment2">
                        {{ $message }}
                    </div>
                @enderror
                <div class="button">
                    <button class="submit" type="submit">
                        送信する
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
</div>
@endsection
