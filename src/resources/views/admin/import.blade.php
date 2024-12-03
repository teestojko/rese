@extends('Layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/Admin/import.css') }}">
@endsection

@section('content')
    <form action="{{ route('admin.import-store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv_file" accept=".csv">
    <button type="submit">インポート</button>
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <p class="error_message">
                    {{ $error }}
                </p>
            @endforeach
        </ul>
    </div>
    @if(session('success'))
        <div class="alert_success">
            {{ session('success') }}
        </div>
    @endif
</form>
@endsection
