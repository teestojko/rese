@php
    $today = now()->format('Y-m-d');
    $currentTime = now()->format('H:i');
@endphp
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="reserve_main">
            予約編集
        </div>
        <form class="reserve_form" action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form_group">
                <label for="reservation_date"></label>
                <input class="input" type="date" id="reservation_date" name="reservation_date" class="form_control" min="{{ $today }}">
                <div class="error_message">
                    @error('reservation_date')
                        <div class="alert alert-danger1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form_group">
                <label for="reservation_time"></label>
                <select id="reservation_time" name="reservation_time" class="form_control2">
                    <option value="">--時間を選択--</option>
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
                <div class="error_message">
                    @error('reservation_time')
                        <div class="alert alert-danger2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form_group">
                <label for="number_of_people"></label>
                <input class="input3" type="number" id="number_of_people" name="number_of_people" class="form-control" min="1" placeholder="人数">
                <div class="error_message">
                    @error('number_of_people')
                        <div class="alert alert-danger3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn-primary">
                更新
            </button>
        </form>
        @if (session('success'))
            <p class="success_message">
                {{ session('success') }}
            </p>
        @endif
        <a class="return_my_page" href="/my_page/{shop}">
            マイページへ戻る
        </a>
    </div>
@endsection
