@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/logs.css') }}">
@endsection

@section('content')
<div class="logs-content">
    <div class="logs-heading">
        <div class="heading-group">
            <p class="title">目標体重</p>
            <p class="content"><span>{{ $targetWeight }}</span>kg
            </p>
        </div>
        <p class="border"></p>
        <div class="heading-group">
            <p class="title">目標まで</p>
            <p class="content"><span>{{ $targetWeight - $latestLog->weight }}</span>kg
            </p>
        </div>
        <p class="border"></p>
        <div class="heading-group">
            <p class="title">最新体重</p>
            <p class="content"><span>{{ $latestLog->weight }}</span>kg
            </p>
        </div>
    </div>

    <div class="logs-inner">
        <div class="logs-inner__top">
            <form action="/weight_logs/search" class="logs-search" method="get">
                <input type="date" class="logs-search__from" name="from" value="{{ old('from', $from ?? '') }}" placeholder="年/月/日">
                <p>~</p>
                <input type="date" class="logs-search__to" name="to" value="{{ old('to', $to ?? '') }}" placeholder="年/月/日">
                <input type="submit" class="search-btn" value="検索">
                @if(isset($from) || isset($to))
                <a href="/weight_logs" class="search_reset-btn">リセット</a>
                @endif
            </form>
            <a href="#create" class="create-btn">データ追加</a>
            @if(isset($from) && isset($to))
            <p class="search-info">{{ $from }}~{{ $to }}の検索結果&nbsp;{{ $count }}件</p>
            @endif
        </div>
        <table class="logs-table">
            <tr class="table-label__row">
                <th class="table-label__date">日付</th>
                <th class="table-label__weight">体重</th>
                <th class="table-label__cal">食事摂取カロリー</th>
                <th class="table-label__time">運動時間</th>
                <th class="table-label"></th>
            </tr>
            @foreach($logs as $log)
            <tr class="table-data__row">
                <td class="logs-data__date">{{ $log->date }}</td>
                <td class="logs-data__weight">{{ $log->weight }}kg</td>
                <td class="logs-data__cal">{{ $log->calories }}cal</td>
                <td class="logs-data__time">{{ $log->exercise_time }}</td>
                <td class="logs-data"><a href="/weight_logs/{{ $log->id }}" class="update-btn"><i class="fa-solid fa-pencil"></i></a></td>
            </tr>
            @endforeach
        </table>
        {{ $logs->links('pagination::bootstrap-4') }}
    </div>
</div>


<div class="modal" id="create">
    <a href="#!" class="modal-overlay"></a>
    @if ($errors->any())
        <script>
            window.location.hash = "create";
        </script>
    @endif
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createWeightModalLabel">Weight&nbsp;Logを追加</h5>
        </div>
        <div class="modal-body">
            <form action="/weight_logs/create" method="post">
                @csrf
                <div class="modal-form__group">
                    <label for="date" class="modal-form__label">日付<span class="modal-form__label-required">必須</span></label>
                    <input type="date" class="modal-form__item-date" id="date" name="date">
                    <div class="error-message">
                        @error('date')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="modal-form__group">
                    <label for="weight" class="modal-form__label">体重<span class="modal-form__label-required">必須</span></label>
                    <div class="input-unit">
                        <input type="text" class="modal-form__item-weight" id="weight" name="weight" value="{{ old('weight') }}" placeholder="50.0"><span>kg</span>
                    </div>
                    <div class="error-message">
                        @error('weight')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="modal-form__group">
                    <label for="calory" class="modal-form__label">摂取カロリー<span class="modal-form__label-required">必須</span></label>
                    <div class="input-unit">
                        <input type="text" class="modal-form__item-cal" id="calory" name="calories" value="{{ old('calories') }}" placeholder="1200"><span>cal</span>
                    </div>
                    <div class="error-message">
                        @error('calories')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="modal-form__group">
                    <label for="exercise_time" class="modal-form__label">運動時間<span class="modal-form__label-required">必須<span></label>
                    <input type="time" class="modal-form__item-time" id="exercise_time" name="exercise_time" value="{{ old('exercise_time') }}" placeholder="00:00">
                    <div class="error-message">
                        @error('exercise_time')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="modal-form__group">
                    <label for="exercise_content" class="modal-form__label">運動内容</label>
                    <textarea class="modal-form__item-content" name="exercise_content" id="exercise_content" cols="30" rows="10" placeholder="運動内容を追加">{{ old('exercise_content') }}</textarea>
                    <div class="error-message">
                        @error('exercise_content')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="modal-form__btn">
                    <a href="#" class="modal__close-btn">戻る</a>
                    <button type="submit" class="modal-create__btn-submit">追加</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection