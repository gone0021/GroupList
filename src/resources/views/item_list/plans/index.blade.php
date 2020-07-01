@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Trip List')}}</div>

<div class="card-body">

    <table class="table">
        <tr>
            <th>
                <span class="mr-2">タイトル</span>
                <a href="{{ url('trips/sort_title_a') }}">↓</a>
                <a href="{{ url('trips/sort_title_d') }}">↑</a>
            </th>
            <th>
                <span class="mr-2">日付</span>
                <a href="{{ url('trips/sort_date_a') }}">↓</a>
                <a href="{{ url('trips/sort_date_d') }}">↑</a>
            </th>
            <th>
                <span class="mr-2">登録者</span>
                <a href="{{ url('trips/sort_user_a') }}">↓</a>
                <a href="{{ url('trips/sort_user_d') }}">↑</a>
            </th>

            <th>状態</th>

            <th>操作</th>
        </tr>

        @foreach ($items as $item)
        <tr>
            {{-- タイトル --}}
            <td>
                {{ $item->plan_title }}
            </td>

            {{-- 日付 --}}
            <td>
                {{ $item->date }}
            </td>

            {{-- 登録者 --}}
            <td>
                {{-- {{ $user }} --}}
                {{ $item->user->user_name }}
                {{-- {{ $item->user->user_name->group_user->group_id }} --}}
            </td>


            {{-- 状態 --}}
            <td>
                @if ($item->is_went === 0)
                未定
                @else
                確定
                @endif
                {{-- {{ $item->is_went }} --}}
            </td>

            {{-- 操作 --}}
            <td>
                <div>
                    {{-- 状態 --}}
                    <form action="{{ url('admin/delete') }}" method="get" class="float-left mr-3">
                        <input type="hidden" name="plan_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Status') }}" class="btn btn-light">
                    </form>

                    {{-- 更新 --}}
                    <form action="{{ url('admin/delete') }}" method="get" class=" float-left mr-3">
                        <input type="hidden" name="plan_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Edit') }}" class="btn btn-light">
                    </form>

                    {{-- 削除 --}}
                    <form action="{{ url('admin/delete') }}" method="get" class="float-left">
                        <input type="hidden" name="plan_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Delete') }}" class="btn btn-light">
                    </form>
                </div>
            </td>
            @endforeach
        </tr>
    </table>


    <div>
        {{-- {{ $items->links() }} --}}
    </div>

    <div class="col-md-10">
        <a href="{{ route('users') }}" class="btn btn-light mr-3">
            {{ __('Return') }}
        </a>

        {{-- 削除済 --}}
        <a href="{{ route('group_deleted') }}" class="btn btn-light">
            {{ __('Deleted') }}
        </a>
    </div>

</div>

@endsection
