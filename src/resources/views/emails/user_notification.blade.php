@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <p>
        {{ $messageContent }}
    </p>
@endsection
