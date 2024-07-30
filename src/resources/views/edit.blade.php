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
    <div class="reserve_main">予約編集</div>
    <form class="reserve_form" action="{{ route('reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
                        <label for="reservation_date">
                        </label>
                        <input class="input" type="date" id="reservation_date" name="reservation_date" class="form_control" required min="{{ $today }}">
                        @error('reservation_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="reservation_time">
                        </label>
                        <select id="reservation_time" name="reservation_time" class="form_control2" required>
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

                        @error('reservation_time')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="number_of_people">
                        </label>
                        <input class="input3" type="number" id="number_of_people" name="number_of_people" class="form-control" min="1" required placeholder="人数">
                        @error('number_of_people')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
        <button type="submit" class="btn-primary">更新</button>
    </form>
</div>
@endsection
