<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
    <title>@yield('title', 'PiGLy')</title>
</head>
<body>
    <div class="field">
        <div class="form">
            <header>
                <h1>PiGLy</h1>
                <h2>新規会員登録</h2>
            </header>
            <main>
                @yield('step')
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
