@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Delete Plan Item')}} ：
    <span class="h5">{{ $items['title'] }}</span>
</div>

<div class="card-body">
    <form method="post" action="{{ url('plans/delete') }}">
        @csrf
        {{-- item_id --}}
        <input type="hidden" name="id" value="{{ $items['id'] }}">

        {{-- item_title --}}
        <div class="form-group row">
            <label for="trip_title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="trip_title" value="{{ $items['trip_title'] }}">

                <span>{{ $items['title'] }}</span>
            </div>
        </div>

        {{-- start --}}
        <div class="form-group row">
            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>
            <div class="col-md-6">
                @php
                $start = date_create($items['start']);
                $start = date_format($start , 'Y-m-d H:i');
                @endphp

                {{ date('y年m月d日 H:i', strtotime($start)) }}
            </div>
        </div>

        {{-- finish --}}
        <div class="form-group row">
            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Finish Time') }}</label>

            <div class="col-md-6">
                @php
                $start = date_create($items['finish']);
                $start = date_format($start , 'Y-m-d H:i');
                @endphp

                {{ date('y年m月d日 H:i', strtotime($start)) }}
            </div>
        </div>

        {{-- status --}}
        <div class="form-group row">
            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="status" value="{{ $items['status'] }}">

                <span>
                    @if ($items['status'] == 0)
                    予定
                    @else
                    確定
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
                    予定
                    @else
                    {{ $items['title'] }}
                    @endif
                </span>
            </div>
        </div>

        <div class="col-md-10 offset-md-2">
            <input type="submit" value="{{ __('Delete') }}" class="mr-3 btn btn-light">

            <a href="{{ url('plans') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>

    </form>

</div>

@endsection
