@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/shop_create.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
@endsection

@section('content')
    <div class="content">
        <div class="detail">
            <div class="top">
                店舗作成画面
            </div>
            @if (session('success'))
                <p>
                    {{ session('success') }}
                </p>
            @endif
            <form class="shop_create_form" action="{{ route('shop_representative.shop_store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="column">
                    <div class="comment">
                        画像
                    </div>
                    <label class="image_path_label" for="image_path" >
                        画像を選択
                    </label>
                    <input type="file" name="image_path" id="image_path">
                    <div id="file_name">
                        選択ファイル名
                    </div>
                </div>
                @error('image_path')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="column">
                    <div class="comment">
                        ショップ名
                    </div>
                    <label class="name_label" for="name"></label>
                    <input type="text" name="name" id="name">
                </div>
                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="column">
                    <div class="comment">
                        エリア
                    </div>
                    <label class="prefecture_label" for="prefecture"></label>
                    <select name="prefecture_id" id="prefecture">
                        <option value="">
                            選択してください
                        </option>
                        @foreach($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ old('prefecture_id') == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('prefecture_id')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="column">
                    <div class="comment">
                        ジャンル
                    </div>
                    <label class="genre_label" for="genre"></label>
                    <select name="genre_id" id="genre">
                        <option value="">
                            選択してください
                        </option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('genre_id')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="column_detail">
                    <div class="comment_detail">
                        詳細
                    </div>
                    <label class="detail_label" for="detail"></label>
                    <textarea name="detail" id="detail">{{ old('detail') }}</textarea>
                </div>
                @error('detail')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="submit_content">
                    <button class="submit" type="submit">
                        店舗を作成
                    </button>
                </div>
            </form>
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <div class="dashboard_button_content">
                <a class="dashboard_button" href="{{ route('shop_representative.dashboard')}}">
                    戻る
                </a>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('image_path').addEventListener('change', function(){
            const fileName = this.files[0].name;
            document.getElementById('file_name').textContent = fileName;
        });
    </script>
@endsection
