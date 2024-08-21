@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/reviews_index.css') }}">


@endsection

@section('content')
<div class="review_top">
    <div class="review_main">
        {{ $shop->name }}のレビュー
    </div>
        @if ($reviews->isEmpty())
            <div class="review_content">この店舗にはまだレビューを投稿していません。</div>
        @else
        <ul class="review_table_ul">
            @foreach ($reviews as $review)
                <table class="review_table">
                    <tr class="review_table_tr_star">
                        <td class="review_table_td">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star {{ $i <= $review->stars ? 'filled' : '' }}">&#9733;</span>
                            @endfor
                        </td>
                    </tr>
                    <tr class="review_table_tr">
                        <td class="review_comment">
                            コメント
                        </td>
                    </tr>
                    <tr class="review_table_tr_comment">
                        <td class="review_table_td_comment">
                            {{ $review->comment }}
                        </td>
                    </tr>
                </table>

                        <form class="review_form" action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="submit" type="submit">
                                レビューを削除
                            </button>
                        </form>
            @endforeach
        </ul>
        @endif
        <div class="review_button_content">
            <a class="review_button" href="{{ route('shops.show', ['shop' => $shop->id]) }}">
                戻る
            </a>
        </div>
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('ellor'))
            <div class="alert-success">
                {{ session('error') }}
            </div>
        @endif
</div>
@endsection
