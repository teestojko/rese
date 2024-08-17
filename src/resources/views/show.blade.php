@php
    $today = now()->format('Y-m-d');
    $currentTime = now()->format('H:i');
@endphp
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
    <div class="shop_all">
        <div class="shop_detail_page">
            <div class="shop_name_top">
                <a href="{{ route('user_my_page') }}" class="btn-secondary">&lt;</a>
                <div class="shop_name">
                    {{ $shop->name }}
                </div>
            </div>
            <img src="{{ asset($shop->image_path) }}" alt="{{ $shop->name }}">
            <div class="shop_detail">
                <div class="show_prefecture_genre">
                    <p class="show_prefecture">
                        <span>
                            #
                        </span>
                        {{ $shop->prefecture->name }}
                    </p>
                    <p class="show_genre">
                        <span>
                            #
                        </span>
                        {{ $shop->genre->name }}
                    </p>
                </div>
                    <p>
                        {{ $shop->detail }}
                    </p>
            </div>
        </div>
        <div class="reservation_form">
            <div class="reservation_content">
                予約
            </div>
            <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
                <div class="input_form">
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <div class="reserve_form-group">
                        <label for="reservation_date">
                        </label>
                        <input class="input" type="date" id="reservation_date" name="reservation_date" class="form-control" required min="{{ $today }}">
                        @error('reservation_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="reserve_form-group">
                        <label for="reservation_time">
                        </label>
                        <select id="reservation_time" name="reservation_time" class="form-control" required>
                            <option value="">時間を選択</option>
                            <option value="17:00">17:00</option>
                            <option value="17:30">17:30</option>
                            <option value="18:00">18:00</option>
                            <option value="18:30">18:30</option>
                            <option value="19:00">19:00</option>
                            <option value="19:30">19:30</option>
                            <option value="20:00">20:00</option>
                            <option value="20:30">20:30</option>
                            <option value="21:00">21:00</option>
                            <option value="21:30">21:30</option>
                            <option value="22:00">22:00</option>
                            <option value="22:30">22:30</option>
                            <option value="23:00">23:00</option>
                            <option value="23:30">23:30</option>
                        </select>

                        @error('reservation_time')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="reserve_form-group">
                        <label for="number_of_people">
                        </label>
                        <input class="input3" type="number" id="number_of_people" name="number_of_people" class="form-control" min="1" required placeholder="人数を選択">
                        @error('number_of_people')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if($nearest_reservation)
                    <div class="reservation_table_main">
                        <table class="reservation_table">
                            <tr class="reservation_tr">
                                <td class="reservation_label">Shop</td>
                                <td class="reservation_value">{{ $shop->name }}</td>
                            </tr>
                            <tr class="reservation_tr">
                                <td class="reservation_label">Date</td>
                                <td class="reservation_value">{{ $nearest_reservation->reservation_date }}</td>
                            </tr>
                            <tr class="reservation_tr">
                                <td class="reservation_label">Time</td>
                                <td class="reservation_value">{{ $nearest_reservation->reservation_time }}</td>
                            </tr>
                            <tr class="reservation_tr">
                                <td class="reservation_label">Number</td>
                                <td class="reservation_value">{{ $nearest_reservation->number_of_people }}人</td>
                            </tr>
                        </table>
                    </div>
                    @endif
                </div>
                <button type="submit" class="btn-primary">
                    予約する
                </button>
            </form>
        </div>
        <div class="review_main">
            <div class="review_form">
                <div class="review_title">レビューを投稿する</div>
                <form class="review_form_detail" action="{{ route('reviews.store', $shop->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="comment">レビュー内容</label>
                        <textarea id="comment" name="comment" class="form-control" required></textarea>
                        @error('comment')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group2">
                        <label class="stars" for="stars">評価</label>
                        <select id="stars" name="stars" class="form-control2" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        @error('stars')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="review_button">
                        <button type="submit" class="submit">投稿する</button>
                        <a href="{{ route('reviews.index', ['shop' => $shop->id]) }}" class="btn-primary2">
                            レビューを確認する
                        </a>
                    </div>
                </form>

            </div>
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-danger">
                    {{ session('error') }}
                </div>
            @endif

                {{-- <div class="reservation-item">
                            <a href="{{ route('reservations.edit', $nearest_reservation->id) }}">
                                <i class="fas fa-edit">予約変更</i>
                            </a>
                        </div> --}}

            <!-- レビュー一覧 -->
            {{-- <div class="reviews">
                <h2>レビュー一覧</h2>
                @foreach($shop->reviews as $review)
                    <div class="review">
                        <div class="review-header">
                            <strong>{{ $review->user->name }}</strong>
                            <span>{{ $review->created_at->format('Y-m-d H:i') }}</span>
                            @if(Auth::id() === $review->user_id)
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">削除</button>
                                </form>
                            @endif
                        </div>
                        <div class="review-body">
                            <p>{{ $review->comment }}</p>
                            <span>評価: {{ $review->stars }}</span>
                        </div>
                    </div>
                @endforeach
            </div> --}}
        </div>
    </div>
@endsection
