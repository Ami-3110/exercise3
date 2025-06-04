<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <title>@yield('title', 'PiGLy')</title>
</head>
<body>
    <header>
        <div class="logo">PiGLy</div>
        <div class="header__buttons">
            <button type="button" class="target__setting" onclick="location.href='{{ url('/weight_target/edit') }}'">目標体重設定</button>
            
            <form method="POST" action="/logout">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
