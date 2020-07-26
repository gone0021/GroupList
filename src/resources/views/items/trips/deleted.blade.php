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
                <a href="{{ url('trips/deleted/sort_title_a') }}?item_type=1">↓</a>
                <a href="{{ url('trips/deleted/sort_title_d') }}?item_type=1">↑</a>
            </th>
            <th>
                <span class="mr-2">日付</span>
                <a href="{{ url('trips/deleted/sort_date_a') }}?item_type=1">↓</a>
                <a href="{{ url('trips/deleted/sort_date_d') }}?item_type=1">↑</a>
            </th>

            <th>状態</th>

            <th>操作</th>
        </tr>

        @foreach ($items as $item)
        <tr>
            {{-- タイトル --}}
            <td>
                {{ $item->title }}
            </td>

            {{-- 日付 --}}
            <td>
                {{ $item->date }}
            </td>

            {{-- 状態 --}}
            <td>
                @if ($item->status == 0)
                気になる
                @else
                行った
                @endif
            </td>

            {{-- 操作 --}}
            <td>
                <div>
                    {{-- 詳細 --}}
                    <form action="{{ url('trips/deleted_detail') }}" method="get" class="float-left mr-3">
                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Detail') }}" class="btn btn-light">
                    </form>
                 </div>

                <div>
                    {{-- 復元 --}}
                    <form action="{{ url('trips/deleted') }}" method="post" class="float-left mr-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Rrestore') }}" class="btn btn-light">
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
        <a href="{{  route('trips') }}" class="btn btn-light">
            {{ __('Return') }}
        </a>
    </div>
</div>

@endsection
