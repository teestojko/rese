@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/Evaluation/edit.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>評価の編集</h2>
    <form action="{{ route('evaluations-update', $evaluation->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="stars">星の数：</label>
            <select name="stars" class="form-control">
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $evaluation->stars == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="comment">コメント：</label>
            <textarea name="comment" class="form-control" required>{{ old('comment', $evaluation->comment) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">画像：</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
