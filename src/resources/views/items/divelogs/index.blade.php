@extends('layouts.cardapp')
@section('card')
<div class="card-header">
    {{ __(' Dive Log')}}
    <span class="ml-5">
        <a href="{{ url('divelogs/new') }}?item_type=1">{{ __( 'New' ) }}</a>
    </span>
</div>

<div class="card-body">

    <table class="table">
        <tr>
            <th>
                <span class="mr-2">No.</span>
            </th>

            <th>
                <span class="mr-2">タイトル</span>
                <a href="{{ url('divelogs/sort_title_a') }}?item_type=1">↓</a>
                <a href="{{ url('divelogs/sort_title_d') }}?item_type=1">↑</a>
            </th>

            <th>
                <span class="mr-2">ポイント名</span>
            </th>

            <th>
                <span class="mr-2">日付</span>
                <a href="{{ url('divelogs/sort_date_a') }}?item_type=1">↓</a>
                <a href="{{ url('divelogs/sort_date_d') }}?item_type=1">↑</a>
            </th>

            <th>操作</th>
        </tr>

        @foreach ($items as $item)
        <tr>
            {{-- タイトル --}}
            <td>{{ $item->dive_num}}
            </td>

            {{-- タイトル --}}
            <td>
                <form action="{{ url('divelogs/detail') }}" method="get" class="float-left mr-3">
                    <input type="hidden" name="id" value="{{ $item->id }}">

                    <input type="submit" value="{{ $item->title }}" class="btn btn-link">
                </form>
            </td>

            {{-- ポイント名 --}}
            <td>
                @if ($item->point !== null)
                {{ $item->point }}
                @else
                未入力
                @endif
            </td>

            {{-- 日付 --}}
            <td>
                {{ date('y年m月d日', strtotime($item->date)) }}
            </td>

            {{-- 操作 --}}
            <td>
                <div>
                    {{-- 更新 --}}
                    <form action="{{ url('divelogs/edit') }}" method="get" class=" float-left mr-3">
                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Edit') }}" class="btn btn-light">
                    </form>

                    {{-- 削除 --}}
                    <form action="{{ url('divelogs/delete') }}" method="get" class="float-left">
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
        <a href="{{ route('divelog_deleted') }}" class="btn btn-light">
            {{ __('Deleted') }}
        </a>
    </div>

</div>

@endsection
