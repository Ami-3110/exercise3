@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/setting.css') }}" />
@endsection

@section('content')

<div class="setting-container">
    <div class="setting__field">
        <h2 class="title">目標体重設定</h2>
        <form action="{{ url('/weight_logs/goal_setting') }}" method="POST" novalidate>
            @csrf
            <div class="setting__form">
                <input type="number" step="0.1" name="target_weight" id="target_weight" 
                    value="{{ old('target_weight', $targetWeight->target_weight) }}" ><span class="setting__unit">kg</span>
            </div>
        
            <div class="buttons">
                <a href="{{ route('weight_logs.index') }}" class="btn-secondary">戻る</a>
                <button type="submit" class="btn-primary">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection
    