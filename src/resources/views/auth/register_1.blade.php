<!DOCTYPE html>
<html>
<head>
    <title>ステップ1：基本情報登録</title>
</head>
<body>
    <header>
        PiGLy
    </header>
    <main>
        <h1>新規会員登録</h1>
        <navi>STEP1 アカウント情報の登録</navi>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:red">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="/register/step1">
            @csrf
            <label>お名前</label>
            <input type="text" name="name" value="{{ old('name') }}" required /><br>
            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" required /><br>
            <label>パスワード</label>
            <input type="password" name="password" required /><br>
            <button type="submit">次に進む</button>
            <div class="login__link" href="">ログインはこちら</div>
        </form>
    </main>
</body>
</html>
