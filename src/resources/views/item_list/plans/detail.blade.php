@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Plan Detail')}} ：
    <span class="h5">{{ $items['plan_title'] }}</span>
</div>

<div class="card-body">
    {{-- plan_title --}}
    <div class="form-group row">
        <label for="plan_title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

        <div class="col-md-6">
            {{ $items['plan_title'] }}
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
            @if ($items['status'] == 0)
            予定
            @else
            確定
            @endif
        </div>

    </div>

    {{-- map_item --}}
    <div class="form-group row">
        <label for="map_item" class="col-md-4 col-form-label text-md-right">{{ __('Map') }}</label>

        <div class="col-md-6">
            {!! $items['map_item'] !!}
        </div>
    </div>

    {{-- comment --}}
    <div class="form-group row">
        <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

        <div class="col-md-6">
            {{ $items['comment'] }}
        </div>
    </div>

    {{-- open_range --}}
    <div class="form-group row">
        <label for="open_range" class="col-md-4 col-form-label text-md-right">{{ __('Open Range') }}</label>

        <div class="col-md-6">
            @if ($items['open_range'] == 0)
            個人
            @else
            グループ
            @endif
        </div>
    </div>

    {{-- is_open --}}
    <div class="form-group row">
        <label for="is_open" class="col-md-4 col-form-label text-md-right">{{ __('Display') }}</label>

        <div class="col-md-6">
            @if ($items['is_open'] == 0)
            予定
            @else
            {{ $items['plan_title'] }}
            @endif
        </div>
    </div>

    <div class="col-md-10 offset-md-2">
        <button type="button" onclick="history.back()" class="btn btn-light">戻る</button>
    </div>


    </form>

</div>

@endsection
