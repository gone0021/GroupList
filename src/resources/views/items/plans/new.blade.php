@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' New Plna Item')}}</div>

<div class="card-body">
    <form method="post" action="{{ url('plans/new') }}">
        @csrf

        {{-- item_type --}}
        <input type="hidden" name="item_type" value="2">

        {{-- item_title --}}
        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input id="title" type="text" name="title" value="{{ old('title') }}"
                    class="form-control @error('title') is-invalid @enderror" placeholder="タイトル" required>

                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- start --}}
        <div class="form-group row">
            <label for="start" class="col-md-4 col-form-label text-md-right">{{ __('Start') }}</label>

            <div class="col-md-6">
                <input id="start" type="datetime-local" name="start" value="{{ old('start') }}"
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
            <label for="finish" class="col-md-4 col-form-label text-md-right">{{ __('Finish') }}</label>

            <div class="col-md-6">
                <input id="finish" type="datetime-local" name="finish" value="{{ old('finish') }}"
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
                <input type="radio" name="status" value="0" @if (old('status')==0) checked @endif id="want" class="">
                <label for="want" class="mr-3">予定</label>

                <input type="radio" name="status" value="1" @if (old('status')==1) checked @endif id="went" class="">
                <label for="went">確定</label>
            </div>
        </div>

        {{-- map --}}
        <div class="form-group row">
            <label for="map" class="col-md-4 col-form-label text-md-right">{{ __('Map') }}</label>

            <div class="col-md-6">
                <input id="map" type="text" name="map" value="{{ old('map') }}"
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

                <input id="comment" type="text" name="comment" value="{{ old('comment') }}"
                class="form-control @error('comment') is-invalid @enderror">

                {{-- <textarea name="comment" id="comment" class="form-control" cols="60" rows="5">
                    {{ old('comment') }}
                </textarea> --}}

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
                    <option value="0">個人</option>
                    <option value="1">グループ</option>
                </select>
            </div>
        </div>

        {{-- is_open --}}
        <div class="form-group row">
            <label for="is_open" class="col-md-4 col-form-label text-md-right">{{ __('Display') }}</label>

            <div class="col-md-6">
                <select name="is_open">
                    <option value="0">詳細表示しない</option>
                    <option value="1">詳細表示する</option>
                </select>
            </div>
        </div>


        <div class="col-md-10 offset-md-2">
            <input type="submit" value="{{ __('Do') }}" class="mr-3 btn btn-light">

            <a href="{{ url('plans') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>
    </form>



</div>

@endsection
