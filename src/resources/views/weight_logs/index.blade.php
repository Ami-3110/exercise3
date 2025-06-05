@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
    
<div class="summary">
    <div class="summary__item">
        <span class="summary__label">目標体重</span>
        <span class="summary__value">{{ $targetWeight }} </span><span class="summary__unit">kg</span>
    </div>
    <div class="summary__item">
        <span class="summary__label">目標まで</span>
        <span class="summary__value">-{{ $difference }} </span><span class="summary__unit">kg</span>
    </div>
    <div class="summary__item">
        <span class="summary__label">最新体重</span>
        <span class="summary__value">{{ $latestLog ->weight }} </span><span class="summary__unit">kg</span>
    </div>
</div>

<div class="surface">
    <div class="search-and-add">
        <!--検索関連 -->
        <form class="form" action="{{ route('weight_logs.search') }}" method="GET">
            <input type="date" name="start_date" value="{{ request('start_date') }}"><span class="date-separator">〜</span>
            <input class="form" type="date" name="end_date" value="{{ request('end_date') }}">
            <button type="submit" class="btn-search">検索</button>

            @if(request()->has('start_date') || request()->has('end_date'))
                <a href="{{ route('weight_logs.index') }}" class="btn-reset">リセット</a>
            @endif
        </form>


        <!--データ追加 -->
        <div>
            <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#addLogModal">データ追加</button>
        </div>
        <!-- 検索結果表示 -->
        @if(request()->has('start_date') || request()->has('end_date'))
        <div class="search-result-summary">
            {{ \Carbon\Carbon::parse(request('start_date'))->format('Y年m月d日') ?? '開始日未指定' }}
            〜
            {{ \Carbon\Carbon::parse(request('end_date'))->format('Y年m月d日') ?? '終了日未指定' }}
            の検索結果 {{ $logs->count() }} 件
        </div>
        @endif
    </div>
    


    <!-- テーブル -->
    <table class="log-table">
        <tr class="table-header-row">
            <th class="col-date">日付</th>
            <th class="col-left">体重</th>
            <th class="col-left">食事摂取カロリー</th>
            <th class="col-left">運動時間</th>
            <th class="col-left"></th>
        </tr>
        <tr class="header-bottom-line">
            <td colspan="5"></td>
        </tr>
        @foreach($logs as $log)
        <tr class="header-bottom-line">
            <td class="col-date">{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
            <td class="col-left">{{ $log->weight }}kg</td>
            <td class="col-left">{{ $log->calories }}kcal</td>
            <td class="col-left">{{ substr($log->exercise_time, 0, 5) }}</td>
            <td class="col-left">
                <a href="{{ url('weight_logs/' . $log->id) }}" title="編集">
                    <img src="{{ asset('images/pencil.png') }}" alt="編集アイコン" class="edit-icon">
                </a>
            </td>
        </tr>
        <tr class="data-bottom-line">
            <td colspan="5"></td>
        </tr>
        @endforeach
    </table>

    {{ $logs->links() }}
</div>

<!-- モーダル本体 -->
<div class="modal fade" id="addLogModal" tabindex="-1" aria-labelledby="addLogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="weight_logs/create">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addLogModalLabel">Weight Logを追加</h5>
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                戻る</button>
            <button type="submit" class="btn btn-primary">登録</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
