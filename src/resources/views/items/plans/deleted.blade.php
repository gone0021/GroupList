@extends('layouts.cardapp')
@section('card')
<div class="card-header">
    {{ __(' Trip List')}}
    <span class="ml-5">
        <a href="{{ url('plans/new') }}?item_type=3">{{ __( 'New' ) }}</a>
    </span>
</div>

<div class="card-body">

    <table class="table">
        <tr>
            <th>
                <span class="mr-2">タイトル</span>
                <a href="{{ url('plans/deleted/sort_title_a') }}?item_type=3">↓</a>
                <a href="{{ url('plans/deleted/sort_title_d') }}?item_type=3">↑</a>
            </th>
            <th>
                <span class="mr-2">日付</span>
                <a href="{{ url('plans/deleted/sort_start_a') }}?item_type=3">↓</a>
                <a href="{{ url('plans/deleted/sort_start_d') }}?item_type=3">↑</a>
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

            {{-- start --}}
            <td>
                @php
                $start = date_create($item->start);
                $start = date_format($start , 'Y-m-d H:i');
                @endphp
                {{-- {{ $item->start }} <br>
                {{ $start }} <br> --}}
                {{ date('y年m月d日', strtotime($start)) }}
            </td>

            {{-- 状態 --}}
            <td>
                @if ($item->status == 0)
                予定
                @else
                確定
                @endif
                {{-- {{ $item->status }} --}}
            </td>

            {{-- 操作 --}}
            <td>
                <div>
                    {{-- 詳細 --}}
                    <form action="{{ url('plans/deleted_detail') }}" method="get" class="float-left mr-3">
                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Detail') }}" class="btn btn-light">
                    </form>
                </div>

                <div>
                    {{-- 復元 --}}
                    <form action="{{ url('plans/deleted') }}" method="post" class="float-left mr-3">
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
        <a href="{{  route('plans') }}" class="btn btn-light">
            {{ __('Return') }}
        </a>
    </div>
</div>

@endsection
