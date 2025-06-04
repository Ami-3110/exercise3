<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>@yield('title', 'PiGLy')</title>
</head>
<body>
    <header>
        <div class="logo">PiGLy</div>
        <div class="header__buttons">
            <img src="{{ asset('images/setting.png') }}" alt="編集アイコン" class="setting-icon"><button type="button" class="target__setting" onclick="location.href='{{ url('/weight_logs/goal_setting') }}'">目標体重設定</button>
            
            <form method="POST" action="/logout">
                @csrf
                <img src="{{ asset('images/logout.png') }}" alt="編集アイコン" class="logout-icon"><button type="submit">ログアウト</button>
            </form>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
