@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
<div class="mypage-top">
        <div class="user-name">
            @if (Auth::check())
        <p class='message'>
            {{ Auth::user()->name }} さん
        </p>
        @endif
        </div>
        <div class="user-reservation">
            <h1>予約情報</h1>

        @if ($reservations->isEmpty())
            <p>予約情報はありません。</p>
        @else
            <ul>
                @foreach ($reservations as $reservation)
                    <li>
                        <p>予約日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</p>
                        <p>人数: {{ $reservation->number_of_people }}名</p>
                        <!-- 他の予約情報の属性を表示 -->
                    </li>
                @endforeach
            </ul>
        @endif
        </div>
        <div class="user-favorite">
            <h2>お気に入り店舗</h2>
            @if ($favorites->count() > 0)
                <ul>
                    @foreach ($favorites as $favorite)
                        <li>{{ $favorite->name }} </li>
                        <li>{{ $favorite->prefecture->name }}</li>
                        <li>{{ $favorite->genre->name }} </li>
                    @endforeach
                </ul>
            @else
                <p>お気に入り店舗はありません。</p>
            @endif
        </div>
</div>
@endsection
