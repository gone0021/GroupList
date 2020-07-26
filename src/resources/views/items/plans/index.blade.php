@extends('layouts.cardapp')
@section('card')
<div class="card-header">
    {{ __(' Plan List')}}
    <span class="ml-5">
        <a href="{{ url('plans/new') }}?item_type=2">{{ __( 'New' ) }}</a>
    </span>
</div>

<div class="card-body">

    <table class="table">
        <tr>
            <th>
                <span class="mr-2">タイトル</span>
                <a href="{{ url('plans/sort_title_a') }}?item_type=2">↓</a>
                <a href="{{ url('plans/sort_title_d') }}?item_type=2">↑</a>
            </th>
            <th>
                <span class="mr-2">日付</span>
                <a href="{{ url('plans/sort_start_a') }}?item_type=2">↓</a>
                <a href="{{ url('plans/sort_start_d') }}?item_type=2">↑</a>
            </th>

            <th>状態</th>

            <th>操作</th>
        </tr>

        @foreach ($items as $item)
        <tr>
            {{-- タイトル --}}

            <td>
                <form action="{{ url('plans/detail') }}" method="get" class="float-left mr-3">
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    {{-- {{ $item->title }} --}}
                    <input type="submit" value="{{ $item->title }}" class="btn btn-link">
                </form>
            </td>

            {{-- 日付 --}}
            <td>
                {{ date('y年m月d日', strtotime($item->start)) }}
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
                    {{-- 状態 --}}
                    <form action="{{ url('plans/status') }}" method="get" class="float-left mr-3">
                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Status') }}" class="btn btn-light">
                    </form>

                    {{-- 更新 --}}
                    <form action="{{ url('plans/edit') }}" method="get" class=" float-left mr-3">
                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Edit') }}" class="btn btn-light">
                    </form>

                    {{-- 削除 --}}
                    <form action="{{ url('plans/delete') }}" method="get" class="float-left">
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
        <a href="{{ route('plan_deleted') }}" class="btn btn-light">
            {{ __('Deleted') }}
        </a>
    </div>

</div>

@endsection
