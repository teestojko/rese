@extends('Layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/Evaluation/evaluation.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
@endsection

@section('content')
    <div class="review">
        <div class="review_inner">
            <div class="inner_title">
                口コミを投稿する
            </div>
            <div id="app"></div> <!-- Reactがここにマウントされる -->
                @error('stars')
                    <div class="alert-danger_star">
                        {{ $message }}
                    </div>
                @enderror
            <form class="review_form" action="{{ route('evaluations-store', $shop->id) }}" method="POST">
            @csrf
                <div class="form_inner">
                    <div class="form_inner_title">
                        <label class="form_inner_label" for="comment">
                            内容
                        </label>
                    </div>
                    <textarea id="comment" name="comment"></textarea>
                </div>
                    @error('comment')
                        <div class="alert_danger_comment">
                            {{ $message }}
                        </div>
                    @enderror
                <div class="form_inner2">
                    <div class="form_inner_title">
                        <label class="form_inner_label" for="stars">
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
                    <div class="review_button_inner">
                        <button type="submit" class="review_button_inner_submit">
                            投稿する
                        </button>
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
        <div class="review_back_button">
            <a class="review_back_button_link" href="{{ route('shops.show', ['shop' => $shop->id]) }}">
                戻る
            </a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.SHOP_ID = {{ $shop->id }};
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
