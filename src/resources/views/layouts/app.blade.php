<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PiGLy</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @yield('css')
</head>
<body>
    <div class="app">
        <header class="header">
            <h1>PiGLy</h1>
            <nav class="header__nav">
                <a href="/weight_logs/goal_setting" class="nav-btn">
                    <i class="fa-solid fa-gear"></i>目標体重設定</a>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="nav-btn">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        ログアウト
                    </button>
                </form>
            </nav>
        </header>
        @yield('content')
    </div>
</body>
</html>