<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Step1RegisterRequest;
use App\Http\Requests\Step2RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // ステップ1表示
    public function showRegisterStep1(){
        return view('auth.register_1');
    }
    // ステップ1：名前・メール・パスワード登録（仮保存）
    public function registerStep1(Step1RegisterRequest $request){
        Session::put('register_data_step1', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect('/register/step2');
    }
    public function showRegisterStep2(){
        // ステップ1の情報がセッションにあるかチェックしてなければリダイレクト
        if (!session()->has('register_data_step1')) {
            return redirect('/register/step1')->withErrors(['message' => 'ステップ1から始めてください']);
        }
        return view('auth.register_2');
    } 
    // ステップ2：体重情報入力、保存
    public function registerStep2(Step2RegisterRequest $request){
        $step1 = Session::get('register_data_step1');
        if (!$step1) {
            return redirect('/register/step1')->withErrors(['message' => 'ステップ1から始めてください']);
        }
        // ユーザー登録
        $user = User::create([
            'name' => $step1['name'],
            'email' => $step1['email'],
            'password' => $step1['password'],
        ]);
        // 目標体重をweight_targetsテーブルに保存
        $user -> weightTarget()->create([
            'target_weight' => $request->input('target_weight'),
        ]);
        // 現在の体重をweight_logsテーブルに最初の記録として保存
        $user->weightLogs()->create([
            'date' => now()->toDateString(),
            'weight' => $request->input('weight'),
            'calories' => 0,               // 初期値として0やnullなど
            'exercise_time' => '00:00:00', // 初期値
            'exercise_content' => '',
        ]);

        Session::forget('register_data_step1');

        // 自動ログイン
        auth()->login($user);

        return redirect('/weight_logs');
    }

     //ログイン処理
    public function login(LoginRequest $request){
    $credentials = $request->only('email', 'password');
    if (auth()->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/weight_logs');
    }

    return redirect('/register/step1');
    }

    

    // ログアウト処理
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
