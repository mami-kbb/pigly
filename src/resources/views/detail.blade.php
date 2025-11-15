@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-content">
    <div class="detail-content__inner">
        <h3>Weight&nbsp;Log</h3>
        <form action="/weight_logs/{{ $log->id }}/update" class="update-form" method="post">
            @method('patch')
            @csrf
            <div class="form-group">
                <label for="date" class="form-label">日付</label>
                <input type="date" class="form-item__date" id="date" name="date" value="{{ old('date', $log->date) }}">
                <p class="error">
                    @error('date')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="form-group">
                <label for="weight" class="form-label">体重</label>
                <div class="input-unit">
                    <input type="text" class="form-item__weight" id="weight" name="weight" value="{{ old('weight', $log->weight) }}"><span>kg</span>
                </div>
                <p class="error">
                    @error('Weight')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="form-group">
                <label for="calory" class="form-label">摂取カロリー</label>
                <div class="input-unit">
                    <input type="text" class="form-item__calories" id="calory" name="calories" value="{{ old('calories', $log->calories) }}" ><span>cal</span>
                </div>
                <p class="error">
                    @error('calories')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="form-group">
                <label for="exercise_time" class="form-label">運動時間</label>
                <input type="time" class="form-item__time" id="exercise_time" name="exercise_time" value="{{ old('exercise_time', \Carbon\Carbon::parse($log->exercise_time)->format('H:i')) }}">
                <p class="error">
                    @error('exercise_time')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="form-group">
                <label for="exercise_content" class="form-label">運動内容</label>
                <textarea class="form-item__content" name="exercise_content" id="exercise_content" cols="30" rows="10" placeholder="運動内容を追加">{{ old('exercise_content', $log->exercise_content) }}</textarea>
                <p class="error">
                    @error('exercise_content')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="form-btn">
                <a href="/weight_logs" class="back-btn">戻る</a>
                <input type="submit" class="form-btn__submit" value="更新">
            </div>
        </form>
        <form action="/weight_logs/{{ $log->id }}/delete" class="delete-form" method="post">
            @method('delete')
            @csrf
            <div class="delete-form__btn">
                <button class="delete-form__btn-submit" type="submit"><i class="fa-solid fa-trash" style="color: red;"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection