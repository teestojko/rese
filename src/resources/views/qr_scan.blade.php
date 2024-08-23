@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/representative/qr_scan.css') }}">
@endsection

@section('content')
    <div>
        <div class="qr_title">
            この画面を保存して、来店時に以下のQRコードを提示してください
        </div>
        <div>
            {!! $qrCode !!}
        </div>
    </div>
@endsection
