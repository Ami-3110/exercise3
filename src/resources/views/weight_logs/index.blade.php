@extends('layouts.app')

@section('content')
    
<div class="summary">
    <div class="summary__item">
        <span class="summary__label">目標体重</span>
        <span class="summary__value">{{ $targetWeight }} kg</span>
    </div>
    <div class="summary__item">
        <span class="summary__label">目標まで</span>
        <span class="summary__value">{{ $difference }} kg</span>
    </div>
    <div class="summary__item">
        <span class="summary__label">最新体重</span>
        <span class="summary__value">{{ $latestWeight }} kg</span>
    </div>
</div>

<form method="POST" action="weight_logs/search">
    @csrf
    <label>
        <input type="date" name="start_date" value="{{ old('start_date') }}">
    </label>
    <label>
        <input type="date" name="end_date" value="{{ old('end_date') }}">
    </label>
    <button type="submit">検索</button>
</form>

<div>
    <a href="weight_logs/create">
        <button type="button">データ追加</button>
    </a>
</div>

<table>
    <tr>
        <th>日付</th>
        <th>体重</th>
        <th>食事摂取カロリー</th>
        <th>運動時間</th>
        <th>仮編集ボタン</th>
    </tr>
    @foreach($logs as $log)
    <tr>
        <td>{{ $log->date }}</td>
        <td>{{ $log->weight }}</td>
        <td>{{ $log->calories }}</td>
        <td>{{ $log->exercise_time }}</td>
        <td>鉛筆マーク</td>
    </tr>
    @endforeach
</table>

{{ $logs->links() }}

@endsection
