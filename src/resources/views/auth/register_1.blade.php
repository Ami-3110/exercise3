@extends('layouts.auth')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register_1.css') }}" />
@endsection

@section('title', '新規会員登録')

@section('step')
    <div class="step">STEP1 アカウント情報の登録</div>
@endsection

@section('content')
    <form method="POST" action="/register/step1">
        @csrf
        
        <label class="form__label">お名前</label>
        <input class="form__input" type="text" name="name" value="{{ old('name') }}" />
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label class="form__label">メールアドレス</label>
        <input class="form__input" type="email" name="email" value="{{ old('email') }}" />
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label class="form__label">パスワード</label>
        <input class="form__input" type="password" name="password" />
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <div class="button">
            <button type="submit">次に進む</button>
        </div>
        <div class="login__link">
            <a href="/login">ログインはこちら</a>
        </div>
    </form>
@endsection
