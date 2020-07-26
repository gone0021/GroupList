@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Edit Dive Log')}} ：
    <span class="h5">{{ $items->title }}</span>
</div>

<div class="card-body">
    <form method="post" action="{{ url('divelogs/edit') }}">
        @csrf

        {{-- item_id --}}
        <input type="hidden" name="id" value="{{ $items->id }}">

        {{-- item_type --}}
        <input type="hidden" name="item_type" value="0">

        <div class="form-group row">
            {{-- dive_num --}}
            <div class="form-group col-md-5 offset-md-1">
                <label for="dive_num" class="col-form-label text-md-right">{{ __('Number') }}</label>

                <input id="dive_num" type="text" name="dive_num" value="{{ $items->dive_num}}"
                    class="form-control @error('dive_num') is-invalid @enderror" placeholder="" required>

                @error('dive_num')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- date --}}
            <div class="form-group col-md-5">
                <label for="date" class="col-form-label text-md-right">{{ __('Date') }}</label>

                <input id="date" type="date" name="date" value="{{ $items->date}}"
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

                <input id="title" type="text" name="title" value="{{ $items->title}}"
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

                <input id="shop_name" type="text" name="shop_name" value="{{ $items->shop_name}}"
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
                <label for="point" class="col-form-label text-md-right">{{ __('Point name') }}</label>

                <input id="point" type="text" name="point" value="{{ $items->point}}"
                    class="form-control @error('point') is-invalid @enderror" placeholder="ポイント名" required>

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
                    <option value="0" @if ($items->entry_type == 0) selected @endif class="">ボート</option>
                    <option value="1" @if ($items->entry_type == 1) selected @endif>ビーチ</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            {{-- start_time --}}
            <div class="form-group col-md-5 offset-md-1">
                <label for="start_time" class="col-form-label text-md-right">{{ __('In Time') }}</label>

                <input id="start_time" type="time" name="start_time" value="{{ $items->start_time}}"
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

                <input id="finish_time" type="time" name="finish_time" value="{{ $items->finish_time}}"
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

                <input id="avg_depth" type="text" name="avg_depth" value="{{ $items->avg_depth}}"
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

                <input id="max_depth" type="text" name="max_depth" value="{{ $items->max_depth}}"
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
                    <option value="0" @if ($items->tank_capacity == 0) selected @endif>10L</option>
                    <option value="1" @if ($items->tank_capacity == 1) selected @endif>12L</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            {{-- start_air --}}
            <div class="form-group col-md-5 offset-1">
                <label for="start_air" class="col-form-label text-md-right">{{ __('Start Air') }}</label>

                <input id="start_air" type="text" name="start_air" value="{{ $items->start_air}}"
                    class="form-control @error('start_air') is-invalid @enderror" placeholder="">

                @error('start_air')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- finish_air --}}
            <div class="form-group col-md-5">
                <label for="finish_air" class="col-form-label text-md-right">{{ __('Finish Are') }}</label>

                <input id="finish_air" type="text" name="finish_air" value="{{ $items->finish_air}}"
                    class="form-control @error('finish_air') is-invalid @enderror" placeholder="">

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

                <input id="water_temp" type="text" name="water_temp" value="{{ $items->water_temp}}"
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

                <input id="temp" type="text" name="temp" value="{{ $items->temp}}"
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
                    <option value="0" @if ($items->Weather == 0) selected @endif>晴れ</option>
                    <option value="1" @if ($items->Weather == 1) selected @endif>曇り</option>
                    <option value="2" @if ($items->Weather == 2) selected @endif>雨</option>
                    <option value="3" @if ($items->Weather == 3) selected @endif>その他</option>
                </select>
            </div>

            {{-- wind --}}
            <div class="form-group col-md-2">
                <label for="wind" class="col-form-label text-md-right">{{ __('Wind') }}</label>

                <select name="wind" class="form-control">
                    <option value="0" @if ($items->wind == 0) selected @endif>弱</option>
                    <option value="1" @if ($items->wind == 1) selected @endif>中</option>
                    <option value="2" @if ($items->wind == 2) selected @endif>強</option>
                </select>
            </div>

            {{-- current --}}
            <div class="form-group col-md-2">
                <label for="current" class="col-form-label text-md-right">{{ __('Current') }}</label>

                <select name="current" class="form-control">
                    <option value="0" @if ($items->current == 0) selected @endif>弱</option>
                    <option value="1" @if ($items->current == 1) selected @endif>中</option>
                    <option value="2" @if ($items->current == 2) selected @endif>強</option>
                </select>
            </div>

            {{-- view --}}
            <div class="form-group col-md-2">
                <label for="view" class="col-form-label text-md-right">{{ __('View') }}</label>

                <input id="view" type="text" name="view" value="{{ $items->view}}"
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
                    <option value="0" @if ($items->suit_type == 0) selected @endif>ワンピース</option>
                    <option value="1" @if ($items->suit_type == 1) selected @endif>2ピース</option>
                    <option value="2" @if ($items->suit_type == 2) selected @endif>セミドライ</option>
                    <option value="3" @if ($items->suit_type == 3) selected @endif>ドライ</option>
                    <option value="4" @if ($items->suit_type == 4) selected @endif>水着</option>
                    <option value="5" @if ($items->suit_type == 5) selected @endif>その他</option>
                </select>
            </div>

            {{-- suit_size --}}
            <div class="form-group col-md-3">
                <label for="suit_size" class="col-form-label text-md-right">{{ __('Suit Size') }}</label>

                <input id="suit_size" type="text" name="suit_size" value="{{ $items->suit_size}}"
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

                <input id="weight" type="text" name="weight" value="{{ $items->weight}}"
                    class="form-control @error('weight') is-invalid @enderror" placeholder="Kg">

                @error('weight')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- map --}}
        <div class="form-group row">
            <label for="map" class="col-md-2 col-form-label text-md-right">{{ __('Map') }}</label>

            <div class="col-md-8">
                <input id="map" type="text" name="map" value="{{ $items->map}}"
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

                <input id="comment" type="text" name="comment" value="{{ $items->comment}}"
                    class="form-control @error('comment') is-invalid @enderror">

                {{-- <textarea name="comment" id="comment" class="form-control" cols="60" rows="5">
                    {{ $items->comment}}
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
                    <option value="0" @if ($items->open_range == 0) selected @endif>個人</option>
                    <option value="1" @if ($items->open_range == 1) selected @endif>グループ</option>
                </select>
            </div>

            {{-- is_open --}}
            <div class="form-group col-md-3">
                <label for="is_open" class="col-form-label text-md-right">{{ __('Display') }}</label>

                <select name="is_open" class="form-control">
                    <option value="0" @if ($items->is_open == 0) selected @endif>詳細表示しない</option>
                    <option value="1" @if ($items->is_open == 1) selected @endif>詳細表示する</option>
                </select>
            </div>
        </div>

        <div class="col-md-10 offset-md-2">
            <input type="submit" value="{{ __('Check') }}" class="mr-3 btn btn-light">

            <a href="{{ url('divelogs') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>


    </form>

</div>

@endsection
