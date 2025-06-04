<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Http\Requests\WeightLogRequest;

class WeightController extends Controller
{
    // 一覧表示
    public function index(){
        $user = auth()->user();

        // 目標体重（最新1件）
        $target = $user->weightTarget; // リレーションがあれば
        $targetWeight = $target ? $target->target_weight : null;

        // 最新体重ログ
        $latestLog = $user->weightLogs()->latest('date')->first();
        $latestWeight = $latestLog ? $latestLog->weight : null;

        // 差分計算
        $difference = null;
        if ($targetWeight !== null && $latestWeight !== null) {
            $difference = $latestWeight - $targetWeight;
        }

        // ログの全件表示
        $logs = $user->weightLogs()->orderBy('date', 'desc')->paginate(8); // 1ページ10件
        return view('weight_logs/index',compact('logs', 'targetWeight', 'latestWeight', 'difference'));
    }

    
        // 新規作成
        public function store(Request $request)
        {
            //
        }
    
    // 検索
    public function search(Request $request){
        $query = WeightLog::query();
    
        if ($request->filled('start_date')){
            $query->where('date', '>=', $request->start_date);
        }
    
        if ($request->filled('end_date')){
            $query->where('date', '<=', $request->end_date);
        }
    
        $logs = $query->orderBy('date', 'desc')->get();
    
        return view('weight_logs.index', compact('logs'));
    }
        
    
        // 詳細表示
        public function show($weightLogId)
        {
            //
        }
    
        // 詳細の更新
        public function update(Request $request, $weightLogId)
        {
            //
        }
    
        // 詳細の削除
        public function delete($weightLogId)
        {
            //
        }
    
        // 目標設定入力
        public function settings(Request $request)
        {
            //
        }
    
        // ログアウト
        public function logout()
        {
            //
        }
}
