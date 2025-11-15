@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css')}}">
@endsection

@section('content')
<div class="goal-content">
    <div class="goal-content__inner">
        <h3>目標体重設定</h3>
        <form action= "/weight_logs/goal_setting" class="weight-form" method="post">
            @method('PATCH')
            @csrf
            <div class="weight-form__item">
                <input type="text" class="weight-form__item-input" name="goal_weight" value="{{ old('goal_weight', $targetWeight) }}">
                <span>kg</span>
                <input type="hidden" name="id" value="{{ $user->id }}">
            </div>
            <p class="error-message">
                @error('goal_weight')
                {{ $message }}
                @enderror
            </p>
            <div class="weight-form__btn">
                <a href="/weight_logs" class="back-btn">戻る</a>
                <input type="submit" class="weight-form__btn-submit" value="更新">
            </div>
        </form>
    </div>
</div>
@endsection