<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Step1RegisterRequest;
use App\Http\Requests\Step2RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // ステップ1：名前・メール・パスワード登録（仮保存）
    public function registerStep1(Step1RegisterRequest $request)
    {
        Session::put('register_data_step1', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect('/register/step2');
    }

    // ステップ2：体重情報入力、保存
    public function registerStep2(Step2RegisterRequest $request)
    {
        $step1 = Session::get('register_data_step1');
        if (!$step1) {
            return redirect('/register/step1')->withErrors(['message' => 'ステップ1から始めてください']);
        }
        $user = User::create([
            'name' => $step1['name'],
            'email' => $step1['email'],
            'password' => $step1['password'],
            'current_weight' => $request->input('current_weight'),
            'target_weight' => $request->input('target_weight'),
        ]);
        Session::forget('register_data_step1');

        // 自動ログインなど必要に応じて
        auth()->login($user);

        return redirect('/weight_logs');
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}
