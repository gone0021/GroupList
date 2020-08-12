@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' New Trip Item')}}</div>

<div class="card-body">
    <form method="post" action="{{ url('trips/new') }}">
        @csrf

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

        {{-- date --}}
        <div class="form-group row">
            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

            <div class="col-md-6">
                <input id="date" type="date" name="date" value="{{ old('date') }}"
                    class="form-control @error('date') is-invalid @enderror" required>

                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- point --}}
        <div class="form-group row">
            <label for="point" class="col-md-4 col-form-label text-md-right">{{ __('Point Name') }}</label>

            <div class="col-md-6">
                <input id="point" type="text" name="point" value="{{ old('point') }}"
                    class="form-control @error('point') is-invalid @enderror" placeholder="ポイント名" required>

                @error('point')
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
                <input id="want" type="radio" name="status" value="0" @if (old('status')==0) checked @endif class="">
                <label for="want" class="mr-3">気になる</label>

                <input id="went" type="radio" name="status" value="1" @if (old('status')==1) checked @endif class="">
                <label for="went">行った</label>
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

                @error('password')
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
                    <option value="1" selected>グループ</option>
                    <option value="0">個人</option>
                </select>
            </div>
        </div>

        {{-- is_open --}}
        <div class="form-group row">
            <label for="is_open" class="col-md-4 col-form-label text-md-right">{{ __('Display') }}</label>

            <div class="col-md-6">
                <select name="is_open">
                    <option value="1" selected>詳細表示する</option>
                    <option value="0">詳細表示しない</option>
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
