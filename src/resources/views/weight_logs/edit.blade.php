@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}" />
@endsection

@section('content')
<div class="edit-container">
    <h2>Weight Log</h2>

    <form action="{{ url('weight_logs/' . $log->id . '/update') }}" method="POST">
        @csrf

        <div>
            <label for="date">日付</label>
            <input type="date" name="date" id="date" value="{{ old('date', $log->date) }}" required>
        </div>

        <div>
            <label for="weight">体重</label>
            <input type="number" step="0.1" name="weight" id="weight" value="{{ old('weight', $log->weight) }}" required>kg
        </div>

        <div>
            <label for="calories">摂取カロリー</label>
            <input type="number" name="calories" id="calories" value="{{ old('calories', $log->calories) }}">kcal
        </div>

        <div>
            <label for="exercise_time">運動時間</label>
            <input type="time" name="exercise_time" id="exercise_time" value="{{ old('exercise_time', $log->exercise_time) }}">
        </div>

        <div>
            <label for="exercise_content">運動内容</label>
            <textarea name="exercise_content" id="exercise_content">{{ old('exercise_content', $log->exercise_content) }}</textarea>
        </div>

        <div class="buttons">
            <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">更新</button>
        </div>
    </form>

    <form action="{{ url('weight_logs/' . $log->id . '/delete') }}" method="POST" style="margin-top: 1em;">
        @csrf
        <button type="submit" class="btn btn-danger" title="削除">
            <img src="{{ asset('images/trash.png') }}" alt="削除アイコン" class="delete-icon">
        </button>
    </form>
</div>
@endsection
