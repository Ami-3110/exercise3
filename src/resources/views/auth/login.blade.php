@extends('layouts.auth')
@section('title', 'ログイン')
@section('content')
    <form method="POST" action="/login">
        @csrf
        
        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}" /><br>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>パスワード</label>
        <input type="password" name="password" /><br>
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