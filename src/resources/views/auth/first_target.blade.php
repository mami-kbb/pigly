<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/first_target.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="content">
        <header class="register-header">
            <h1>PiGLy</h1>
            <h2>新規会員登録</h2>
            <p class="step">STEP2&nbsp;体重データの入力</p>
        </header>
        <form action="/register/step2" class="form" method="post">
            @csrf
            <div class="form-group">
                <label for="current_weight" class="form-group__label">現在の体重</label>
                <input type="text" class="form-group__input" name="current_weight" value="{{ old('current_weight') }}" placeholder="現在の体重を入力"><span>kg</span>
                <p class="error-message">
                    @error('current_weight')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="form-group">
                <label for="target_weight" class="form-group__label">目標の体重</label>
                <input type="text" class="form-group__input" name="target_weight" value="{{ old('target_weight') }}" placeholder="目標の体重を入力">
                <span>kg</span>
                <p class="error-message">
                    @error('target_weight')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="form-btn">
                <input type="submit" class="form-btn__submit" value="アカウント作成">
            </div>
        </form>
    </div>
</body>
</html>