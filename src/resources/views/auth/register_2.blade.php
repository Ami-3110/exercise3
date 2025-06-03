<!DOCTYPE html>
<html>
<head>
    <title>ステップ2：体重情報登録</title>
</head>
<body>
    <header>
        PiGLy
    </header>
    <main>
        <h1>新規会員登録</h1>
        <navi>STEP2 体重データの入力</navi>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register/step2">
        @csrf
        <label>現在の体重 (kg):</label>
        <input type="number" step="0.1" name="current_weight" value="{{ old('current_weight') }}" placeholder="現在の体重を入力">kg<br>

        <label>目標の体重 (kg):</label>
        <input type="number" step="0.1" name="target_weight" value="{{ old('target_weight') }}" placeholder="目標の体重を入力">kg<br>

        <button type="submit">アカウント作成</button>
    </form>
</body>
</html>