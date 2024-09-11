@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
@endsection

@section('content')
    <div class="review_main">
        <div class="review_form">
            <div class="review_title">
                レビューを投稿する
            </div>
            <form class="review_form_detail" action="{{ route('reviews.store', $shop->id) }}" method="POST">
            @csrf
                <div class="form_group">
                    <div class="comment_detail">
                        <label class="comment" for="comment">
                            レビュー内容
                        </label>
                    </div>
                    <textarea id="comment" name="comment"></textarea>
                </div>
                    @error('comment')
                        <div class="alert_danger_comment">
                            {{ $message }}
                        </div>
                    @enderror
                <div class="form_group2">
                    <div class="comment_detail">
                        <label class="comment2" for="stars">
                            評価
                        </label>
                    </div>
                    <select id="select" name="stars">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    @error('stars')
                        <div class="alert-danger_star">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="review_button">
                    <div class="submit_content">
                        <button type="submit" class="submit">
                            投稿する
                        </button>
                    </div>
                    <div class="review_confirm">
                        <a href="{{ route('reviews.index', ['shop' => $shop->id]) }}" class="btn-primary2">
                            レビューを確認する
                        </a>
                    </div>
                </div>
            </form>
        </div>
        @if(session('success'))
            <div class="alert_success">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->has('custom_error'))
            <div class="alert_danger">
                {{ $errors->first('custom_error') }}
            </div>
        @endif
        <div class="review_button_content">
            <a class="review_button" href="{{ route('shops.show', ['shop' => $shop->id]) }}">
                戻る
            </a>
        </div>
    </div>
@endsection
