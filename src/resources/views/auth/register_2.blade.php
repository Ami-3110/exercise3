@extends('layouts.auth')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register_2.css') }}" />
@endsection

@section('title', '新規会員登録')

@section('step')
    <div class="step">STEP2 体重データの入力</div>
@endsection

@section('content')
    <form method="POST" action="/register/step2">
        @csrf
        <label class="form__label">現在の体重</label>
        <div class="input__group">
            <input class="form__input" type="number" step="0.1" name="weight" value="{{ old('weight') }}" placeholder="現在の体重を入力"/><span class="unit"> kg</span><br>
        </div>
        @error('weight')
            <div class="error">{{ $message }}</div>
        @enderror

        <label class="form__label">目標の体重</label>
        <div class="input__group">
            <input class="form__input" type="number" step="0.1" name="target_weight" value="{{ old('target_weight') }}" placeholder="目標の体重を入力"><span class="unit"> kg</span><br>
        </div>
        @error('target_weight')
            <div class="error">{{ $message }}</div>
        @enderror

        <div class="button">
            <button type="submit">アカウント作成</button>
        </div>
    </form>
@endsection