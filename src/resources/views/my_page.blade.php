@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <div class="user_name">
        @if (Auth::check())
        <p class='message'>
            {{ Auth::user()->name }} さん
        </p>
        @endif
    </div>
    <div class="my_page_top">
        <div class="reservation_main">
            <div class="user_my_page_title">
                予約状況
            </div>
            <div class="reservation_main2">
                <div class="table_main">
                    @if ($all_reservations->isEmpty())
                        <p>
                            予約情報はありません。
                        </p>
                    @else
                    @foreach ($all_reservations as $reservation)
                        <div class="table_detail2">
                            <table class="reserve_table">
                                <div class="reservation_id_table">
                                    <i class="fa-regular fa-clock"></i>
                                    <div class="reservation_id">
                                        予約{{ $loop->iteration }}
                                    </div>
                                    <p class="p_button">
                                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
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
                                        <td class="reserve_label">
                                            Shop
                                        </td>
                                        <td class="reserve_value">
                                            {{ $reservation->shop->name }}
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="reserve_tr">
                                        <td class="reserve_label">
                                            Date
                                        </td>
                                        <td class="reserve_value">
                                            {{ $reservation->reservation_date }}
                                        </td>
                                    </tr>
                                    <tr class="reserve_tr">
                                        <td class="reserve_label">
                                            Time
                                        </td>
                                        <td class="reserve_value">
                                            {{ $reservation->reservation_time }}
                                        </td>
                                    </tr>
                                    <tr class="reserve_tr">
                                        <td class="reserve_label">
                                            Number
                                        </td>
                                        <td class="reserve_value">
                                            {{ $reservation->number_of_people }}人
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form_content">
                                <div class="reservation_item">
                                    <a href="{{ route('reservations.edit', $reservation->id) }}">
                                        <i class="fas fa-edit">
                                            予約変更
                                        </i>
                                    </a>
                                </div>
                                <a class="qr_scan" href="{{ route('qr_scanner', $reservation->id) }}">
                                    QR表示
                                </a>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="user_favorite">
            <div class="user_my_page_main2">
                お気に入り店舗
            </div>
            @if ($favorites->isEmpty())
                <p>
                    お気に入り店舗はありません。
                </p>
            @else
                <ul class="user_my_page_ul">
                    @foreach ($favorites as $favorite)
                    <div class="user_my_page_item">
                        <img class="user_my_page_img" src="{{ asset($favorite->image_path) }}" alt="{{ $favorite->name }}">
                        <div class="user_my_page_detail">
                            <div class="user_my_page_name">
                                {{ $favorite->name }}
                            </div>
                            <div class="user_my_page_prefecture_genre">
                                <p class="user_my_page_prefecture">
                                    <span>
                                        #
                                    </span>
                                    {{ $favorite->prefecture->name }}
                                </p >
                                <p class="user_my_page_genre">
                                    <span>
                                        #
                                    </span>
                                    {{ $favorite->genre->name }}
                                </p>
                            </div>
                            <div class="user_my_page_primary_favorite">
                                <p class="user_my_page_primary">
                                    <a href="{{ route('shops.show', ['shop' => $favorite->id]) }}" class="btn-primary">
                                        詳しく見る
                                    </a>
                                </p>
                                <form class="user_my_page_form" action="{{ $favorite->isFavorited() ? route('favorites.toggle.remove', ['shop' => $favorite->id]) : route('favorites.toggle.add', ['shop' => $favorite->id]) }}" method="POST">
                                @csrf
                                    @if ($favorite->isFavorited())
                                        @method('DELETE')
                                        <button type="submit" class="submit">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    @else
                                        <button type="submit" class="submit2">
                                            <i class="far fa-heart"></i>
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
    </div>
@endsection
