@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Edit Plan Item')}} ：
    <span class="h5">{{ $items->title }}</span>
</div>

<div class="card-body">
    <form method="post" action="{{ url('plans/edit') }}">
        @csrf

        {{-- item_id --}}
        <input type="hidden" name="id" value="{{ $items->id }}">

        {{-- item_title --}}
        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input id="title" type="text" name="title" value="{{ $items->title }}"
                    class="form-control @error('title') is-invalid @enderror" required>

                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- start --}}
        <div class="form-group row">
            <label for="start" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

            {{-- @php
            $start = date_create($items->start);
            $start = date_format($start , 'Y-m-d H:i');
            @endphp --}}
            <div class="col-md-6">
                <input id="start" type="datetime-local" name="start" value="{{ $items->start }}"
                    class="form-control @error('start') is-invalid @enderror" required>

                @error('start')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- finish --}}
        <div class="form-group row">
            <label for="finish" class="col-md-4 col-form-label text-md-right">{{ __('Finish Time') }}</label>

            <div class="col-md-6">
                <input id="finish" type="datetime-local" name="finish" value="{{ $items->finish }}"
                    class="form-control @error('finish') is-invalid @enderror" required>

                @error('finish')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- status --}}
        <div class="form-group row">
            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

            <div class="col-md-6">
                <input type="radio" name="status" value="0" @if ($items->status == 0) checked @endif id="want"
                class="">
                <label for="want" class="mr-3">予定</label>

                <input type="radio" name="status" value="1" @if ($items->status == 1) checked @endif id="went"
                class="">
                <label for="went">確定</label>
            </div>
        </div>

        {{-- map --}}
        <div class="form-group row">
            <label for="map" class="col-md-4 col-form-label text-md-right">{{ __('Map') }}</label>

            <div class="col-md-6">
                <input id="map" type="text" name="map" value="{{ $items->map }}"
                    class="form-control @error('map') is-invalid @enderror">

                @error('map')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <p>
                    <a href="https://www.google.co.jp/maps/" target="blank">GoogleMap</a>から「共有→地図を埋め込む」のURLを貼り付けてください
                </p>
            </div>

        </div>

        {{-- comment --}}
        <div class="form-group row">
            <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

            <div class="col-md-6">
                <input id="comment" type="text" name="comment" value="{{ $items->comment }}"
                    class="form-control @error('comment') is-invalid @enderror">

                @error('comment')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- open_range --}}
        <div class="form-group row">
            <label for="open_range" class="col-md-4 col-form-label text-md-right">{{ __('Open Range') }}</label>

            <div class="col-md-6">
                <select name="open_range">
                    <option value="0" @if ($items->open_range == '0') selected @endif>個人</option>
                    <option value="1" @if ($items->open_range == '1') selected @endif>グループ</option>
                </select>
            </div>
        </div>

        {{-- is_open --}}
        <div class="form-group row">
            <label for="is_open" class="col-md-4 col-form-label text-md-right">{{ __('Display') }}</label>

            <div class="col-md-6">
                <select name="is_open">
                    <option value="0" @if ($items->is_open == '0') selected @endif>詳細表示しない</option>
                    <option value="1" @if ($items->is_open == '1') selected @endif>詳細表示する</option>
                </select>
            </div>
        </div>

        <div class="col-md-10 offset-md-2">
            <input type="submit" value="{{ __('Check') }}" class="mr-3 btn btn-light">

            <a href="{{ url('plans') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>


    </form>

</div>

@endsection
