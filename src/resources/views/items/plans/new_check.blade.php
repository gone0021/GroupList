@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' New Plna Item')}}</div>

<div class="card-body">
    <form method="post" action="{{ url('plans/create') }}">
        @csrf
        {{-- user_id --}}
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        {{-- item_title --}}
        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="title" value="{{ $items['title'] }}">

                <span>{{ $items['title'] }}</span>
            </div>
        </div>

        {{-- start --}}
        <div class="form-group row">
            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="start" value="{{ $items['start'] }}">

                @php
                $start = date_create($items['start']);
                $start = date_format($start , 'Y-m-d H:i');
                @endphp
                {{ date('y年m月d日 H:i', strtotime($start)) }}
            </div>
        </div>

        {{-- finish --}}
        <div class="form-group row">
            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

            <div class="col-md-6">
                <input type="hidden" name="finish" value="{{ $items['finish'] }}">

                @php
                $finish = date_create($items['finish']);
                $finish = date_format($finish , 'Y-m-d H:i');
                @endphp
                {{ date('y年m月d日 H:i', strtotime($finish)) }}
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
            <input type="submit" value="{{ __('Do') }}" class="mr-3 btn btn-light">

            <button type="button" onclick="history.back()" class="btn btn-light">戻る</button>
        </div>


    </form>

</div>

@endsection
