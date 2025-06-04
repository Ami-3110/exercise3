@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/setting.css') }}" />
@endsection

@section('content')
<div class="setting-container">
    <h2>目標体重設定</h2>
    <form action="{{ url('/weight_logs/goal_setting') }}" method="POST">
        @csrf
    
        <div>
            <label for="target_weight">目標体重(kg)</label>
            <input type="number" step="0.1" name="target_weight" id="target_weight" 
                   value="{{ old('target_weight', $targetWeight->target_weight) }}" required>
        </div>
    
        <div class="buttons">
            <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">更新</button>
        </div>
    </form>
    </div>
    @endsection
    