@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Delete Trip Item')}} ：
    <span class="h5">{{ $items->title }}</span>
</div>

<div class="card-body">
    <form method="post" action="{{ url('trips/delete') }}">
        @csrf
        {{-- user_id --}}
        <input type="hidden" name="id" value="{{ $items->id }}">

        {{-- title --}}
        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="title" value="{{ $items['title'] }}">

                <span>{{ $items['title'] }}</span>
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

        {{-- point --}}
        <div class="form-group row">
            <label for="point" class="col-md-4 col-form-label text-md-right">{{ __('Point Name') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="point" value="{{ $items['point'] }}">

                <span>{{ $items['point'] }}</span>
            </div>
        </div>

        {{-- status --}}
        <div class="form-group row">
            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="status" value="{{ $items['status'] }}">

                <span>
                    @if ($items['status'] == 0)
                    気になる
                    @else
                    行った
                    @endif
                </span>
            </div>
        </div>

        {{-- map --}}
        <div class="form-group row">
            <label for="map" class="col-md-4 col-form-label text-md-right">{{ __('Map') }}</label>

            <div class="col-md-6">
                @if ($items['map'] !== null)
                <input type="hidden" name="map" value="{{ $items['map'] }}">
                <span>{!! $items['map'] !!}</span>
                @else
                <input type="hidden" name="map" value="">
                <span>登録なし</span>
                @endif
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
                    {{ $items['title'] }}
                    @endif
                </span>
            </div>
        </div>

        <div class="col-md-10 offset-md-2">
            <input type="submit" value="{{ __('Delete') }}" class="mr-3 btn btn-light">

            <a href="{{ url('trips') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>


    </form>

</div>

@endsection
