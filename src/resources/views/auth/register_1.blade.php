@extends('layouts.auth')

@section('title', 'ステップ1：基本情報登録')

@section('step')
    <navi>STEP1 アカウント情報の登録</navi>
@endsection

@section('content')
    <form method="POST" action="/register/step1">
        @csrf
        
        <label>お名前</label>
        <input type="text" name="name" value="{{ old('name') }}" /><br>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

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
            <a href="/login">ログインはこちら</a>
        </div>
    </form>
@endsection
