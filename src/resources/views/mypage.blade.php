@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
    <div class="mypage_top">
        <div class="user_name">
            @if (Auth::check())
        <p class='message'>
            {{ Auth::user()->name }} さん
        </p>
        @endif
        </div>

        {{-- <div class="user_mypage"> --}}
            <div class="user_reservation">
                <div class="user_mypage_main">
                    予約状況
                </div>

                @if ($nearest_reservation)
                <div class="table_main">
                    <table class="reserve_table">
                        <div class="reservation_id_table">
                            <i class="fa-regular fa-clock"></i>
                                <div class="reservation_id">予約
                                    {{-- {{$reservation->id}} --}}
                                </div>
                                <p class="p_button">
                                    <form action="{{ route('reservations.destroy', $nearest_reservation->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </p>
                        </div>
                        <thead>
                            <tr class="reserve_tr">
                                <td class="reserve_label">Shop</td>
                                <td class="reserve_value">{{ $nearest_reservation->shop->name }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="reserve_tr">
                                <td class="reserve_label">Date</td>
                                <td class="reserve_value">{{ $nearest_reservation->reservation_date }}</td>
                            </tr>
                            <tr class="reserve_tr">
                                <td class="reserve_label">Time</td>
                                <td class="reserve_value">{{ $nearest_reservation->reservation_time }}</td>
                            </tr>
                            <tr class="reserve_tr">
                                <td class="reserve_label">Number</td>
                                <td class="reserve_value">{{ $nearest_reservation->number_of_people }}人</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p>
                        予約情報はありません。
                    </p>
                @endif
                </div>
            </div>
            <div class="user_favorite">
                <div class="user_mypage_main2">
                    お気に入り店舗
                </div>
                @if ($favorites->isEmpty())
                    <p>
                        お気に入り店舗はありません。
                    </p>
                @else
                    <ul class="user_mypage_ul">
                        @foreach ($favorites as $favorite)
                        <div class="user_mypage_item">
                            <img class="user_mypage_img" src="{{ asset($favorite->image_path) }}" alt="{{ $favorite->name }}">
                            <div class="user_mypage_detail">
                                <div class="user_mypage_name">
                                    {{ $favorite->name }}
                                </div>
                                <div class="user_mypage_prefecture_genre">
                                    <p class="user_mypage_prefecture">
                                    <span>
                                        #
                                    </span>
                                        {{ $favorite->prefecture->name }}
                                    </p >
                                    <p class="user_mypage_genre">
                                    <span>
                                        #
                                    </span>
                                        {{ $favorite->genre->name }}
                                    </p>
                                </div>
                                <div class="user_mypage_primary_favorite">
                                    <p class="user_mypage_primary">
                                        <a href="{{ route('shops.show', ['shop' => $favorite->id]) }}" class="btn-primary">
                                            詳しく見る
                                        </a>
                                    </p>
                                    <form class="user_mypage_form" action="{{ $favorite->isFavorited() ? route('favorites.toggle.remove', ['shop' => $favorite->id]) : route('favorites.toggle.add', ['shop' => $favorite->id]) }}" method="POST">
                                    @csrf
                                        @if ($favorite->isFavorited())
                                            @method('DELETE')
                                            <button type="submit" class="submit">
                                                <i class="fas fa-heart" style="color: red; background: none; border: none; font-size: 24px;"></i>
                                            </button>
                                        @else
                                            <button type="submit" class="submit2">
                                                <i class="far fa-heart" style="color: #c7c7c7;; background: none; border: none; font-size: 24px;"></i>
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </ul>
                @endif
            </div>
        {{-- </div> --}}
    </div>
@endsection
