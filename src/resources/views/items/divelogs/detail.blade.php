@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Dive Log Detail')}} ：
    <span class="h5">{{ $items['title'] }}</span>
</div>
<div class="card-body">
    <form method="post" action="{{ url('divelogs/update') }}">
        <div class="form-group row">
            {{-- dive_num --}}
            <div class="form-group col-md-5 offset-md-1">
                <label for="dive_num" class="col-form-label text-md-right">{{ __('Number') }} ： </label>

                <span>No. {{ $items['dive_num'] }}</span>
            </div>

            {{-- date --}}
            <div class="form-group col-md-5">
                <label for="date" class="col-form-label text-md-right">{{ __('Date') }} ： </label>

                <span>{{ $items['date'] }}</span>
            </div>
        </div>

        <div class="form-group row">
            {{-- item_title --}}
            <div class="form-group col-md-5 offset-1">
                <label for="title" class="col-form-label text-md-right">{{ __('Title') }} ： </label>

                <span>{{ $items['title'] }}</span>
            </div>

            {{-- shop_name --}}
            <div class="form-group col-md-5">
                <label for="shop_name" class="col-form-label text-md-right">{{ __('Shop') }} ： </label>

                <span>{{ $items['date'] }}</span>
            </div>
        </div>

        <div class="form-group row">
            {{-- point --}}
            <div class="form-group col-md-5 offset-1">
                <label for="point" class="col-form-label text-md-right">{{ __('Point Name') }} ： </label>

                <span>{{ $items['point']}}</span>
            </div>

            {{-- entry_type --}}
            <div class="form-group col-md-5">
                <label for="entry_type" class="col-form-label text-md-right">{{ __('Entry Type ') }} ： </label>

                <span>
                    @if ($items['entry_type'] == 0)
                    ボート
                    @else
                    ビーチ
                    @endif
                </span>
            </div>
        </div>

        <div class="form-group row">
            {{-- start_time --}}
            <div class="form-group col-md-5 offset-1">
                <label for="start_time" class="col-form-label text-md-right">{{ __('In Time') }} ： </label>

                <span>{{ $items['start_time'] }}</span>
            </div>

            {{-- finish_time --}}
            <div class="form-group col-md-5">
                <label for="finish_time" class="col-form-label text-md-right">{{ __('Out Time') }} ： </label>

                <span>{{ $items['finish_time'] }}</span>
            </div>
        </div>

        <div class="form-group row">
            {{-- avg_depth --}}
            <div class="form-group col-md-5 offset-1">
                <label for="avg_depth" class="col-form-label text-md-right">{{ __('Average Depth') }} ： </label>

                <span>{{ $items['avg_depth'] }} m</span>
            </div>

            {{-- max_depth --}}
            <div class="form-group col-md-5">
                <label for="max_depth" class="col-form-label text-md-right">{{ __('Max Depth') }} ： </label>

                <span>{{ $items['max_depth'] }} m</span>
            </div>
        </div>

        <div class="form-group row">
            {{-- tank_material --}}
            <div class="form-group col-md-5 offset-1">
                <label for="tank_material" class="col-form-label text-md-right">{{ __('Tank Material') }} ： </label>

                <span>{{ $items['tank_material'] }}</span>
            </div>

            {{-- tank_capacity --}}
            <div class="form-group col-md-5">
                <label for="tank_capacity" class="col-form-label text-md-right">{{ __('Tank Capacity') }} ： </label>

                <span>
                    @if ($items['tank_capacity'] == 0)
                    10L
                    @else
                    12L
                    @endif
                </span>
            </div>
        </div>

        <div class="form-group row">
            {{-- start_air --}}
            <div class="form-group col-md-5 offset-1">
                <label for="start_air" class="col-form-label text-md-right">{{ __('Start Air') }} ： </label>

                <span>{{ $items['start_air'] }} bar</span>
            </div>

            {{-- finish_air --}}
            <div class="form-group col-md-5">
                <label for="finish_air" class="col-form-label text-md-right">{{ __('Finish Are') }} ： </label>

                <span>{{ $items['finish_air'] }} bar</span>
            </div>
        </div>

        <div class="form-group row">
            {{-- weather --}}
            <div class="form-group col-md-3 offset-1">
                <label for="weather" class="col-form-label text-md-right">{{ __('Weather') }} ： </label>

                <span>
                    @if ($items['weather'] == 0)
                    晴れ
                    @elseif ($items['weather'] == 1)
                    曇り
                    @elseif ($items['weather'] == 2)
                    雨
                    @elseif ($items['weather'] == 3)
                    その他
                    @endif
                </span>
            </div>

            {{-- water_temp --}}
            <div class="form-group col-md-3">
                <label for="water_temp" class="col-form-label text-md-right">{{ __('Water Temp') }} ： </label>

                <span>{{ $items['water_temp'] }} ℃</span>
            </div>

            {{-- temp --}}
            <div class="form-group col-md-3">
                <label for="temp" class="col-form-label text-md-right">{{ __('Temp') }} ： </label>

                <span>{{ $items['temp'] }} ℃</span>
            </div>
        </div>

        <div class="form-group row">

            {{-- wind --}}
            <div class="form-group col-md-3 offset-1">
                <label for="wind" class="col-form-label text-md-right">{{ __('Wind') }} ： </label>

                <span>
                    @if ($items['wind'] == 0)
                    弱
                    @elseif ($items['wind'] == 1)
                    中
                    @elseif ($items['wind'] == 2)
                    強
                    @endif
                </span>
            </div>

            {{-- current --}}
            <div class="form-group col-md-3">
                <label for="current" class="col-form-label text-md-right">{{ __('Current') }} ： </label>

                <span>
                    @if ($items['current'] == 0)
                    弱
                    @elseif ($items['current'] == 1)
                    中
                    @elseif ($items['current'] == 2)
                    強
                    @endif
                </span>

            </div>

            {{-- view --}}
            <div class="form-group col-md-3">
                <label for="view" class="col-form-label text-md-right">{{ __('View') }} ： </label>

                <span>{{ $items['view'] }}</span>
            </div>
        </div>

        <div class="form-group row">
            {{-- suit_type --}}
            <div class="form-group col-md-3 offset-1">
                <label for="suit_type" class="col-form-label text-md-right">{{ __('Suit Type') }} ： </label>

                <span>
                    @if ($items['current'] == 0)
                    ワンピース
                    @elseif ($items['current'] == 1)
                    2ピース
                    @elseif ($items['current'] == 2)
                    セミドライ
                    @elseif ($items['current'] == 3)
                    ドライ
                    @elseif ($items['current'] == 4)
                    水着
                    @elseif ($items['current'] == 5)
                    その他
                    @endif
                </span>
            </div>

            {{-- suit_size --}}
            <div class="form-group col-md-3">
                <label for="suit_size" class="col-form-label text-md-right">{{ __('Suit Size') }} ： </label>

                <span>{{ $items['suit_size'] }} mm</span>
            </div>

            {{-- weight --}}
            <div class="form-group col-md-3">
                <label for="weight" class="col-form-label text-md-right">{{ __('Weight') }} ： </label>

                <span>{{ $items['weight'] }} Kg</span>
            </div>
        </div>

        {{-- map --}}
        <div class="form-group row">
            <label for="map" class="col-md-4 col-form-label text-md-right">{{ __('Map') }} ： </label>

            <div class="col-md-6">
                @if ($items['map'] !== null)
                <span>{!! $items['map'] !!}</span>
                @else
                <span>登録なし</span>
                @endif
            </div>
        </div>

        {{-- comment --}}
        <div class="form-group row">
            <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }} ： </label>

            <div class="col-md-6">
                <span>{{ $items['comment'] }}
            </div>
        </div>

        {{-- open_range --}}
        <div class="form-group row">
            <div class="form-group col-md-3 offset-1">
                <label for="open_range" class="col-form-label text-md-right">{{ __('Open Range') }} ： </label>

                <span>
                    @if ($items['open_range'] == 0)
                    個人
                    @else
                    グループ
                    @endif
                </span>
            </div>

            {{-- is_open --}}
            <div class="form-group col-md-3">
                <label for="is_open" class="col-form-label text-md-right">{{ __('Display') }} ： </label>

                <span>
                    @if ($items['is_open'] == 0)
                    場所
                    @else
                    {{ $items['title'] }}
                    @endif
                </span>
            </div>
        </div>

        <div class="col-md-10 offset-md-2">
            <button type="button" onclick="history.back()" class="btn btn-light">戻る</button>
        </div>


    </form>

</div>

@endsection
