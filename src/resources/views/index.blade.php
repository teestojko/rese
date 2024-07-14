@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

@endsection

@section('content')
    <div class="shop_list">
        @foreach($shops as $shop)
            <div class="shop_item">
                <img class="shop_img" src="{{ asset($shop->image_path) }}" alt="{{ $shop->name }}">
                <div class="shop_detail">
                    <div class="shop_name">
                        {{ $shop->name }}
                    </div>
                        <div class="shop_prefecture_genre">
                            <p class="shop_prefecture">
                            <span>
                                #
                            </span>
                                {{ $shop->prefecture->name }}
                            </p >
                            <p class="shop_genre">
                            <span>
                                #
                            </span>
                                {{ $shop->genre->name }}
                            </p>
                        </div>
                        <div class="shop_primary_favorite">
                            <p class="shop_primary">
                                <a href="{{ route('shops.show', ['shop' => $shop->id]) }}" class="btn-primary">詳しく見る</a>
                            </p>
                            <form class="shop_form" action="{{ $shop->isFavorited() ? route('favorites.toggle.remove', ['shop' => $shop->id]) : route('favorites.toggle.add', ['shop' => $shop->id]) }}" method="POST">
                            @csrf
                                @if ($shop->isFavorited())
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
    </div>
@endsection
