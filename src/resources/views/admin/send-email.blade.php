@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <h1>Send Email to User</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.send-email') }}" method="POST">
        @csrf
        <div>
            <label for="user_id">Select User:</label>
            <select name="user_id" id="user_id" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" required>
        </div>
        <div>
            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="5" required></textarea>
        </div>
        <div>
            <button type="submit">Send Email</button>
        </div>
    </form>
@endsection
