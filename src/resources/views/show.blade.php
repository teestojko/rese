@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
    <div class="shop_all">
        <div class="shop_detail_page">
            <h2>
                {{ $shop->name }}
            </h2>
            <img src="{{ asset($shop->image_path) }}" alt="{{ $shop->name }}">
            <div class="shop_detail">
                <div class="show_prefecture_genre">
                    <p class="show_prefecture">
                        <span>
                            #
                        </span>
                        {{ $shop->prefecture }}
                    </p>
                    <p class="show_genre">
                        <span>
                            #
                        </span>
                        {{ $shop->genre }}
                    </p>
                </div>
                    <p>
                        {{ $shop->detail }}
                    </p>
            </div>
            <p class="shop_purchase">
                <a href="{{ route('payment.show') }}" class="btn btn-success">カード決済</a>
            </p>
        </div>
        <div class="reservation_form">
            <h3>
                予約
            </h3>
            <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
                <div class="input_form">
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    <div class="form-group">
                        <label for="reservation_date">
                        </label>
                        <input class="input" type="date" id="reservation_date" name="reservation_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="reservation_time">
                        </label>
                        <input class="input2" type="time" id="reservation_time" name="reservation_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="number_of_people">
                        </label>
                        <input class="input2" type="number" id="number_of_people" name="number_of_people" class="form-control" min="1" required>
                    </div>
                </div>
                <button type="submit" class="btn-primary">
                    予約する
                </button>
            </form>
        </div>
    </div>
@endsection
