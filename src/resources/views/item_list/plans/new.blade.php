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
            <label for="plan_title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input id="plan_title" type="text" class="form-control @error('plan_title') is-invalid @enderror"
                    name="plan_title" value="{{ old('plan_title') }}" placeholder="タイトル" required>

                @error('plan_title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- start --}}
        <div class="form-group row">
            <label for="start" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

            <div class="col-md-6">
                <input id="start" type="datetime-local" class="form-control @error('start') is-invalid @enderror" name="start"
                    value="{{ old('start') }}" required>

                @error('start')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- finish --}}
        <div class="form-group row">
            <label for="finish" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

            <div class="col-md-6">
                <input id="finish" type="datetime-local" class="form-control @error('finish') is-invalid @enderror" name="finish"
                    value="{{ old('finish') }}" required>

                @error('finish')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- point_name --}}
        <div class="form-group row">
            <label for="point_name" class="col-md-4 col-form-label text-md-right">{{ __('Point Name') }}</label>

            <div class="col-md-6">
                <input id="point_name" type="text" class="form-control @error('point_name') is-invalid @enderror"
                    name="point_name" value="{{ old('point_name') }}" placeholder="ポイント名" required>

                @error('point_name')
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

        {{-- map_item --}}
        <div class="form-group row">
            <label for="map_item" class="col-md-4 col-form-label text-md-right">{{ __('Map') }}</label>

            <div class="col-md-6">
                <input id="map_item" type="text" class="form-control @error('map_item') is-invalid @enderror"
                    name="map_item">
                @error('map_item')
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
                <input id="comment" type="text" class="form-control" name="comment" value="{{ old('comment') }}">
                {{-- <textarea name="comment" id="comment" class="form-control" cols="60" rows="5">
                    {{ old('comment') }}
                </textarea> --}}

                {{-- @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror --}}
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

            <a href="{{ url('trips') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>
    </form>



</div>

@endsection
