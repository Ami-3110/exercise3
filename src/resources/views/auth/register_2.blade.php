@extends('layouts.auth')
@section('title', '新規会員登録')

@section('step')
    <navi>STEP2 体重データの入力</navi>
@endsection

@section('content')
    <form method="POST" action="/register/step2">
        @csrf
        <label>現在の体重 (kg):</label>
        <input type="number" step="0.1" name="weight" value="{{ old('weight') }}" placeholder="現在の体重を入力"/>kg<br>
        @error('weight')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>目標の体重 (kg):</label>
        <input type="number" step="0.1" name="target_weight" value="{{ old('target_weight') }}" placeholder="目標の体重を入力">kg<br>
        @error('target_weight')
            <div class="error">{{ $message }}</div>
        @enderror

        <div class="button">
            <button type="submit">アカウント作成</button>
        </div>
    </form>
@endsection