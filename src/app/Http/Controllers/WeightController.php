<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function index()
    {
        return view('weight_logs');
    }

    
        // 新規作成
        public function store(Request $request)
        {
            //
        }
    
        // 検索
        public function search(Request $request)
        {
            //
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
