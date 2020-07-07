@extends('layouts.cardapp')
@section('card')
<div class="card-header">
    {{ __(' Trip List')}}
    <span class="ml-5">
        <a href="{{ url('trips/new') }}?item_type=1">{{ __( 'New' ) }}</a>
    </span>
</div>

<div class="card-body">

    <table class="table">
        <tr>
            <th>
                <span class="mr-2">タイトル</span>
                <a href="{{ url('trips/sort_title_a') }}?item_type=1">↓</a>
                <a href="{{ url('trips/sort_title_d') }}?item_type=1">↑</a>
            </th>
            <th>
                <span class="mr-2">日付</span>
                <a href="{{ url('trips/sort_date_a') }}?item_type=1">↓</a>
                <a href="{{ url('trips/sort_date_d') }}?item_type=1">↑</a>
            </th>

            <th>状態</th>

            <th>操作</th>
        </tr>

        @foreach ($items as $item)
        <tr>
            {{-- タイトル --}}

            <td>
                {{-- <a href="{{ url('trips/detail') }}?item_type={{ $item->id }}"> {{ $item->plan_title }} </a> --}}
                {{-- {{ $item->plan_title }} --}}

                <form action="{{ url('trips/detail') }}" method="get" class="float-left mr-3">
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    {{-- {{ $item->plan_title }} --}}
                    <input type="submit" value="{{ $item->trip_title }}" class="btn btn-link">
                </form>
            </td>

            {{-- 日付 --}}
            <td>
                {{ date('y年m月d日', strtotime($item->date)) }}
            </td>

            {{-- 状態 --}}
            <td>
                @if ($item->status == 0)
                気になる
                @else
                行った
                @endif
                {{-- {{ $item->status }} --}}
            </td>

            {{-- 操作 --}}
            <td>
                <div>
                    {{-- 状態 --}}
                    <form action="{{ url('trips/status') }}" method="get" class="float-left mr-3">
                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Status') }}" class="btn btn-light">
                    </form>

                    {{-- 更新 --}}
                    <form action="{{ url('trips/edit') }}" method="get" class=" float-left mr-3">
                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Edit') }}" class="btn btn-light">
                    </form>

                    {{-- 削除 --}}
                    <form action="{{ url('trips/delete') }}" method="get" class="float-left">
                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Delete') }}" class="btn btn-light">
                    </form>
                </div>
            </td>
            @endforeach
        </tr>
    </table>


    <div>
        {{ $items->links() }}
    </div>

    <div class="col-md-10">
        <a href="{{ route('item_list') }}" class="btn btn-light mr-3">
            {{ __('Return') }}
        </a>

        {{-- 削除済 --}}
        <a href="{{ route('trip_deleted') }}" class="btn btn-light">
            {{ __('Deleted') }}
        </a>
    </div>

</div>

@endsection
