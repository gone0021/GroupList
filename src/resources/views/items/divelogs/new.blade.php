@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' New Dive Log')}}</div>

<div class="card-body">
    <form method="post" action="{{ url('divelogs/new') }}">
    {{-- <form method="post" action="{{ url('divelogs/new') }}" class=”form-inline”> --}}
        @csrf

        <div class="form-group row">
            {{-- dive_num --}}
            <div class="form-group col-md-5 offset-md-1">
                <label for="dive_num" class="col-form-label text-md-right">{{ __('Number') }}</label>

                <input id="dive_num" type="text" name="dive_num" value="{{ old('dive_num') }}"
                    class="form-control @error('dive_num') is-invalid @enderror" placeholder="次は {{ $val+1 }}" required>
                @error('dive_num')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- date --}}
            <div class="form-group col-md-5">
                <label for="date" class="col-form-label text-md-right">{{ __('Date') }}</label>

                <input id="date" type="date" name="date" value="{{ old('date') }}"
                    class="form-control @error('date') is-invalid @enderror" required>

                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            {{-- item_title --}}
            <div class="form-group col-md-5 offset-1">
                <label for="title" class="col-form-label text-md-right">{{ __('Title') }}</label>

                <input id="title" type="text" name="title" value="{{ old('title') }}"
                    class="form-control @error('title') is-invalid @enderror" placeholder="タイトル" required>

                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- shop_name --}}
            <div class="form-group col-md-5">
                <label for="shop_name" class="col-form-label text-md-right">{{ __('Shop') }}</label>

                <input id="shop_name" type="text" name="shop_name" value="{{ old('shop_name') }}"
                    class="form-control @error('shop_name') is-invalid @enderror" placeholder="ショップ名">

                @error('shop_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            {{-- point --}}
            <div class="form-group  col-md-7 offset-md-1">
                <label for="point" class="col-form-label text-md-right">{{ __('Point Name') }}</label>

                <input id="point" type="text" name="point" value="{{ old('point') }}"
                    class="form-control @error('point') is-invalid @enderror" placeholder="ポイント名">

                @error('point')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- entry_type --}}
            <div class="form-group  col-md-3">
                <label for="entry_type" class="col-form-label text-md-right">{{ __('Entry Type') }}</label>

                <select id="entry_type" name="entry_type" class="form-control">
                    <option value="0">ボート</option>
                    <option value="1">ビーチ</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            {{-- start_time --}}
            <div class="form-group col-md-5 offset-md-1">
                <label for="start_time" class="col-form-label text-md-right">{{ __('In Time') }}</label>

                <input id="start_time" type="time" name="start_time" value="{{ old('start_time') }}"
                    class="form-control @error('start_time') is-invalid @enderror">

                @error('start_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- finish_time --}}
            <div class="form-group col-md-5">
                <label for="finish_time" class="col-form-label text-md-right">{{ __('Out Time') }}</label>

                <input id="finish_time" type="time" name="finish_time" value="{{ old('finish_time') }}"
                    class="form-control @error('finish_time') is-invalid @enderror">

                @error('finish_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            {{-- avg_depth --}}
            <div class="form-group col-md-5 offset-1">
                <label for="avg_depth" class="col-form-label text-md-right">{{ __('Average Depth') }}</label>

                <input id="avg_depth" type="text" name="avg_depth" value="{{ old('avg_depth') }}"
                    class="form-control @error('avg_depth') is-invalid @enderror" placeholder="m">

                @error('avg_depth')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- max_depth --}}
            <div class="form-group col-md-5">
                <label for="max_depth" class="col-form-label text-md-right">{{ __('Max Depth') }}</label>

                <input id="max_depth" type="text" name="max_depth" value="{{ old('max_depth') }}"
                    class="form-control @error('max_depth') is-invalid @enderror" placeholder="m">

                @error('max_depth')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            {{-- tank_material --}}
            <div class="form-group col-md-5 offset-1">
                <label for="tank_material" class="col-form-label text-md-right">{{ __('Tank Material') }}</label>

                <select name="tank_material" class="form-control">
                    <option value="0">スチール</option>
                    <option value="1">アルミ</option>
                </select>
            </div>

            {{-- tank_capacity --}}
            <div class="form-group col-md-5">
                <label for="tank_capacity" class="col-form-label text-md-right">{{ __('Tank Capacity') }}</label>

                <select name="tank_capacity" class="form-control">
                    <option value="0">10L</option>
                    <option value="1">12L</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            {{-- start_air --}}
            <div class="form-group col-md-5 offset-1">
                <label for="start_air" class="col-form-label text-md-right">{{ __('Start Air') }}</label>

                <input id="start_air" type="text" name="start_air" value="{{ old('start_air') }}"
                    class="form-control @error('start_air') is-invalid @enderror" placeholder="bar">

                @error('start_air')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- finish_air --}}
            <div class="form-group col-md-5">
                <label for="finish_air" class="col-form-label text-md-right">{{ __('Finish Are') }}</label>

                <input id="finish_air" type="text" name="finish_air" value="{{ old('finish_air') }}"
                    class="form-control @error('finish_air') is-invalid @enderror" placeholder="bar">

                @error('finish_air')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            {{-- water_temp --}}
            <div class="form-group col-md-5 offset-1">
                <label for="water_temp" class="col-form-label text-md-right">{{ __('Water Temp') }}</label>

                <input id="water_temp" type="text" name="water_temp" value="{{ old('water_temp') }}"
                    class="form-control @error('water_temp') is-invalid @enderror" placeholder="℃">

                @error('water_temp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- temp --}}
            <div class="form-group col-md-5">
                <label for="temp" class="col-form-label text-md-right">{{ __('Temp') }}</label>

                <input id="temp" type="text" name="temp" value="{{ old('temp') }}"
                    class="form-control @error('temp') is-invalid @enderror" placeholder="℃">

                @error('temp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            {{-- weather --}}
            <div class="form-group col-md-2 offset-1">
                <label for="weather" class="col-form-label text-md-right">{{ __('Weather') }}</label>

                <select name="weather" class="form-control">
                    <option value="0">晴れ</option>
                    <option value="1">曇り</option>
                    <option value="2">雨</option>
                    <option value="3">その他</option>
                </select>
            </div>

            {{-- wind --}}
            <div class="form-group col-md-2">
                <label for="wind" class="col-form-label text-md-right">{{ __('Wind') }}</label>

                <select name="wind" class="form-control">
                    <option value="0">弱</option>
                    <option value="1">中</option>
                    <option value="2">強</option>
                </select>
            </div>

            {{-- current --}}
            <div class="form-group col-md-2">
                <label for="current" class="col-form-label text-md-right">{{ __('Current') }}</label>

                <select name="current" class="form-control">
                    <option value="0">弱</option>
                    <option value="1">中</option>
                    <option value="2">強</option>
                </select>
            </div>

            {{-- view --}}
            <div class="form-group col-md-2">
                <label for="view" class="col-form-label text-md-right">{{ __('View') }}</label>

                <input id="view" type="text" name="view" value="{{ old('view') }}"
                    class="form-control @error('view') is-invalid @enderror" placeholder="m">

                @error('view')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            {{-- suit_type --}}
            <div class="form-group col-md-3 offset-1">
                <label for="suit_type" class="col-form-label text-md-right">{{ __('Suit Type') }}</label>

                <select name="suit_type" class="form-control">
                    <option value="0">ワンピース</option>
                    <option value="1">2ピース</option>
                    <option value="2">セミドライ</option>
                    <option value="3">ドライ</option>
                    <option value="4">水着</option>
                    <option value="5">その他</option>
                </select>
            </div>

            {{-- suit_size --}}
            <div class="form-group col-md-3">
                <label for="suit_size" class="col-form-label text-md-right">{{ __('Suit Size') }}</label>

                <input id="suit_size" type="text" name="suit_size" value="{{ old('suit_size') }}"
                    class="form-control @error('suit_size') is-invalid @enderror" placeholder="mm">

                @error('suit_size')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- weight --}}
            <div class="form-group col-md-3">
                <label for="weight" class="col-form-label text-md-right">{{ __('Weight') }}</label>

                <input id="weight" type="text" name="weight" value="{{ old('weight') }}"
                    class="form-control @error('weight') is-invalid @enderror" placeholder="Kg">

                @error('weight')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- map--}}
        <div class="form-group row">
            <label for="map" class="col-md-2 col-form-label text-md-right">{{ __('Map') }}</label>

            <div class="col-md-8">
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
            <label for="comment" class="col-md-2 col-form-label text-md-right">{{ __('Comment') }}</label>

            <div class="col-md-8">

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

        <div class="form-group row">
            {{-- open_range --}}
            <div class="form-group col-md-3 offset-1">
                <label for="open_range" class="col-form-label text-md-right">{{ __('Open Range') }}</label>

                <select name="open_range" class="form-control">
                    <option value="1" selected>グループ</option>
                    <option value="0">個人</option>
                </select>
            </div>

            {{-- is_open --}}
            <div class="form-group col-md-3">
                <label for="is_open" class="col-form-label text-md-right">{{ __('Display') }}</label>

                <select name="is_open" class="form-control">
                    <option value="1" selected>詳細表示する</option>
                    <option value="0">詳細表示しない</option>
                </select>
            </div>
        </div>


        <div class="col-md-10 offset-md-2">
            <input type="submit" value="{{ __('Do') }}" class="mr-3 btn btn-light">

            <a href="{{ url('divelogs') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>
    </form>



</div>

@endsection
