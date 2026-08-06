<!DOCTYPEhtml>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<script src="js/main.js"></script>
</html>
@extends('layouts.auth')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('title', 'ログイン')

@section('content')
    <form method="POST" action="/login">
        @csrf
        
        <label class="form__label">メールアドレス</label>
        <input class="form__input" type="email" name="email" value="{{ old('email') }}" /><br>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label class="form__label">パスワード</label>
        <input class="form__input" type="password" name="password" /><br>
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <div class="button">
            <button type="submit">次に進む</button>
        </div>
        <div class="login__link">
            <a href="/register/step1">アカウント作成はこちら</a>
        </div>
    </form>
@endsection
