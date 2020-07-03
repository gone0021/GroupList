@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Edit Trip List')}}</div>

<div class="card-body">
    <form method="post" action="{{ url('trips/update') }}">
        @csrf

        {{-- item_id --}}
        <input type="hidden" name="id" value="{{ $items['id'] }}">

        {{-- item_type --}}
        <input type="hidden" name="item_type" value="1">

        {{-- trip_title --}}
        <div class="form-group row">
            <label for="trip_title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="trip_title" value="{{ $items['trip_title'] }}">

                <span>{{ $items['trip_title'] }}</span>
            </div>
        </div>

        {{-- date --}}
        <div class="form-group row">
            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="date" value="{{ $items['date'] }}">

                <span>{{ $items['date'] }}</span>
            </div>
        </div>

        {{-- point_name --}}
        <div class="form-group row">
            <label for="point_name" class="col-md-4 col-form-label text-md-right">{{ __('Point Name') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="point_name" value="{{ $items['point_name'] }}">

                <span>{{ $items['point_name'] }}</span>
            </div>
        </div>

        {{-- is_went --}}
        <div class="form-group row">
            <label for="is_went" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="is_went" value="{{ $items['is_went'] }}">

                <span>
                    @if ($items['is_went'] == 0)
                    気になる
                    @else
                    行った
                    @endif
                </span>
            </div>

        </div>

        {{-- map_item --}}
        <div class="form-group row">
            <label for="map_item" class="col-md-4 col-form-label text-md-right">{{ __('Map') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="map_item" value="{{ $items['map_item'] }}">

                <span>{!! $items['map_item'] !!}</span>
            </div>
        </div>

        {{-- comment --}}
        <div class="form-group row">
            <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="comment" value="{{ $items['comment'] }}">

                <span>{{ $items['comment'] }}
            </div>
        </div>

        {{-- open_range --}}
        <div class="form-group row">
            <label for="open_range" class="col-md-4 col-form-label text-md-right">{{ __('Open Range') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="open_range" value="{{ $items['open_range'] }}">

                <span>
                    @if ($items['open_range'] == 0)
                    個人
                    @else
                    グループ
                    @endif
                </span>
            </div>
        </div>

        {{-- is_open --}}
        <div class="form-group row">
            <label for="is_open" class="col-md-4 col-form-label text-md-right">{{ __('Display') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="is_open" value="{{ $items['is_open'] }}">

                <span>
                    @if ($items['is_open'] == 0)
                    場所
                    @else
                    {{ $items['trip_title'] }}
                    @endif
                </span>
            </div>
        </div>

        <div class="col-md-10 offset-md-2">
            <input type="submit" value="{{ __('Do') }}" class="mr-3 btn btn-light">

            <button type="button" onclick="history.back()"  class="btn btn-light">戻る</button>
        </div>


    </form>

</div>

@endsection
