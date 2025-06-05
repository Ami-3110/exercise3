<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Http\Requests\WeightLogRequest;
use App\Http\Requests\SettingRequest;

class WeightController extends Controller
{
    // 一覧表示
    public function index(){
        $logs = auth()->user()->weightLogs()->orderBy('date', 'desc')->paginate(8);
    
        return view('weight_logs.index', array_merge(
            ['logs' => $logs],
            $this->getCommonData()
        ));
    }
    
    

    
    // 新規作成
    public function store(WeightLogRequest $request){
        $user = Auth::user();

        $validated = $request->validated();

        $log = new WeightLog();
        $log->user_id = $user->id;
        $log->date = $validated['date'];
        $log->weight = $validated['weight'];
        $log->calories = $validated['calories'] ?? null;
        $log->exercise_time = $validated['exercise_time'] ?? null;
        $log->exercise_content = $validated['exercise_content'] ?? null;

        $log->save();

        return redirect()->route('weight_logs.index');
        }
    
    // 検索
    public function search(Request $request){
        $query = auth()->user()->weightLogs();
    
        if ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        }
    
        if ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }
    
        $logs = $query->orderBy('date', 'desc')->paginate(8)->appends($request->all());
    
        return view('weight_logs.index', array_merge(
            ['logs' => $logs],
            $this->getCommonData()
        ));
    }
    
    // 編集表示
    public function show($weightLogId){
        $log = WeightLog::findOrFail($weightLogId);
    
        // 自分のデータか確認（セキュリティのため）
        if ($log->user_id !== auth()->id()) {
            abort(403);
        }
    
        return view('weight_logs.edit', compact('log'));
    }
        
    
    // 詳細の更新
    public function update(WeightLogRequest $request, $weightLogId){
        $log = WeightLog::findOrFail($weightLogId);
    
        if ($log->user_id !== auth()->id()) {
            abort(403);
        }
    
        $log->update($request->validated());
    
        return redirect()->route('weight_logs.index');
    }
    

    
    // 詳細の削除
    public function delete($weightLogId){
        $log = WeightLog::findOrFail($weightLogId);

        if ($log->user_id !== auth()->id()) {
            abort(403);
        }

        $log->delete();

        return redirect()->route('weight_logs.index');
}

    
    // 目標設定表示
    public function showSettings(){
        $user = auth()->user();
        $targetWeight = $user->weightTarget()->first();

        return view('weight_targets.setting', compact('targetWeight'));
    }

    // 目標設定更新
    public function updateSettings(SettingRequest $request){
        $user = auth()->user();

        $validated = $request->validated();

        $user->weightTarget()->updateOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => $validated['target_weight']]
        );

        return redirect()->route('weight_logs.index');
    }

        

    // ログアウト
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }


        // 目標・差分・現在の共通処理
        private function getCommonData(){
            $user = auth()->user();
            $targetWeight = $user->weightTarget->target_weight ?? null;
            $latestLog = $user->weightLogs()->latest('date')->first();
            $difference = $latestLog && $targetWeight ? $latestLog->weight - $targetWeight : null;

            return compact('targetWeight', 'latestLog', 'difference');
        }

}
