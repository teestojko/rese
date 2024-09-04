@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="">予約確認</div>
        <p>
            予約ID: {{ $reservation->id }}
        </p>
        <p>
            お名前: {{ $reservation->customer_name }}
        </p>
        <p>
            予約日時: {{ $reservation->reservation_date }}
        </p>
        <form action="{{ route('confirm_check_in', $reservation->id) }}" method="POST">
        @csrf
            <button type="submit" class="btn btn-primary">
                予約確認済み
            </button>
        </form>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endsection
