<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログアウトテスト</title>
</head>
<body>
    <h1>ログイン成功！</h1>
    <p>ここは仮の weight_logs ページです。</p>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</body>
</html>
