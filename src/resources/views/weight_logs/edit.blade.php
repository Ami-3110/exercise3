@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}" />
@endsection

@section('content')
<div class="edit-container">
    <div class="edit-inner">
        <h2 class="edit-title">Weight Log</h2>

        <form action="{{ url('weight_logs/' . $log->id . '/update') }}" method="POST" novalidate>
            @csrf

            <div class="edit-form">
                <label class="form-label" for="date">日付</label>
                <input class="form-ctrl" type="date" name="date" id="date" value="{{ old('date', $log->date) }}">
                @error('date')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-form">
                <label class="form-label" for="weight">体重</label>
                <div class="input-with-unit">
                    <input class="form-ctrl" type="text" inputmode="decimal" name="weight" id="weight" value="{{ old('weight', $log->weight) }}"><span class="edit__unit">kg</span>
                </div>
                @error('weight')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-form">
                <label class="form-label" for="calories">摂取カロリー</label>
                <div class="input-with-unit">
                    <input class="form-ctrl" type="number" name="calories" id="calories" value="{{ old('calories', $log->calories) }}"><span class="edit__unit">kcal</span>
                </div>
                @error('calories')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-form">
                <label class="form-label" for="exercise_time">運動時間</label>
                <input class="form-ctrl" type="time" name="exercise_time" id="exercise_time" value="{{ old('exercise_time', $log->exercise_time) }}">
                @error('exercise_time')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-form">
                <label class="form-label" for="exercise_content">運動内容</label>
                <textarea class="form-ctrl" name="exercise_content" id="exercise_content">{{ old('exercise_content', $log->exercise_content) }}</textarea>
                @error('exercise_content')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="btn-wrapper">
                <a href="{{ route('weight_logs.index') }}" class="btn-secondary">戻る</a>
                <button type="submit" class="btn-primary">更新</button>
            </div>
        </form>
        <div class="delete-wrapper">
            <form action="{{ url('weight_logs/' . $log->id . '/delete') }}" method="POST">
                @csrf
                <button type="submit" class="delete-btn" title="削除">
                    <img src="{{ asset('images/trash.png') }}" alt="削除アイコン" class="delete-icon">
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
