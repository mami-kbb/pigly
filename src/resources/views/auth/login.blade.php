<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="content">
        <header class="login-header">
            <h1>PiGLy</h1>
            <h2>ログイン</h2>
        </header>
        <form action="/login" class="form" method="post">
            @csrf
            <div class="form-group">
                <label for="email" class="form-group__label">メールアドレス</label>
                <input type="email" class="form-group__input" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
                <p class="error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="form-group">
                <label for="password" class="form-group__label">パスワード</label>
                <input type="password" class="form-group__input" name="password" value="{{ old('password') }}" placeholder="パスワードを入力">
                <p class="error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="form-btn">
                <input type="submit" class="form-btn__submit" value="ログイン">
            </div>
        </form>
        <a href="/register/step1" class="register">アカウント作成はこちら</a>
    </div>
</body>
</html>