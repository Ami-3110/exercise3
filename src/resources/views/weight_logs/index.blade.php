@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

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
        <span class="summary__value">{{ $latestLog ->weight }} kg</span>
    </div>
</div>

<!--検索関連 -->
<form action="{{ route('weight_logs.search') }}" method="GET">
    <input type="date" name="start_date" value="{{ request('start_date') }}">
    <input type="date" name="end_date" value="{{ request('end_date') }}">
    <button type="submit">検索</button>

    @if(request()->has('start_date') || request()->has('end_date'))
        <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">リセット</a>
    @endif
</form>


<!--データ追加 -->
<div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLogModal">
        データ追加
    </button>
</div>


<!-- モーダル本体 -->
<table>
    <tr>
        <th>日付</th>
        <th>体重</th>
        <th>食事摂取カロリー</th>
        <th>運動時間</th>
        <th></th>
    </tr>
    @foreach($logs as $log)
    <tr>
        <td>{{ $log->date }}</td>
        <td>{{ $log->weight }}kg</td>
        <td>{{ $log->calories }}kcal</td>
        <td>{{ $log->exercise_time }}</td>
        <td>
            <a href="{{ url('weight_logs/' . $log->id) }}" title="編集">
                <img src="{{ asset('images/pencil.png') }}" alt="編集アイコン" class="edit-icon">
            </a>
        </td>
    </tr>
    @endforeach
</table>

{{ $logs->links() }}


<!-- モーダル本体 -->
<div class="modal fade" id="addLogModal" tabindex="-1" aria-labelledby="addLogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="weight_logs/create">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addLogModalLabel">新規ログ追加</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="date" class="form-label">日付</label>
              <input type="date" class="form-control" name="date" required>
            </div>
            <div class="mb-3">
              <label for="weight" class="form-label">体重 (kg)</label>
              <input type="number" class="form-control" name="weight" step="0.1" required>
            </div>
            <div class="mb-3">
              <label for="calories" class="form-label">摂取カロリー</label>
              <input type="number" class="form-control" name="calories">
            </div>
            <div class="mb-3">
              <label for="exercise_time" class="form-label">運動時間</label>
              <input type="time" class="form-control" name="exercise_time">
            </div>
            <div class="mb-3">
              <label for="exercise_content" class="form-label">運動内容</label>
              <input type="text" class="form-control" name="exercise_content">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">追加</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
