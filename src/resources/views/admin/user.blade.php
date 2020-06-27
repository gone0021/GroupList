@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' User List')}} </div>

<div class="card-body">

    <table class="table">
        <tr>
            <th>
                <span class="mr-2">id</span>
                <a href="{{ url('admin/user/sort_id_a') }}">↓</a>
                <a href="{{ url('admin/user/sort_id_d') }}">↑</a>
            </th>
            <th>
                <span class="mr-2">ユーザー名</span>
                <a href="{{ url('admin/user/sort_name_a') }}">↓</a>
                <a href="{{ url('admin/user/sort_name_d') }}">↑</a>
            </th>
            <th>操作</th>
        </tr>
        @foreach ($items as $item)
        <tr>
            <td>
                {{ $item->id }}
            </td>
            <td>
                {{ $item->user_name }}
            </td>

            <td>
                <div>
                    {{-- 詳細 --}}
                    <form action="{{ url('admin/user/show') }}" method="get" class="float-left mr-3">
                        <input type="hidden" name="user_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Detail') }}" class="btn btn-light">
                    </form>

                    {{-- 参加クループ --}}
                    <form action="{{ url('admin/user/group') }}" method="get" class="float-left mr-3">
                        <input type="hidden" name="user_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Group') }}" class="btn btn-light">
                    </form>

                    {{-- 削除（テスト用） --}}
                    <form action="{{ url('admin/user/delete') }}" method="get" class="float-both">
                        <input type="hidden" name="user_id" value="{{ $item->id }}">
                        @if (Auth::user()->is_admin !== $item->is_admin)
                        <input type="submit" value="{{ __('Delete') }}" class="btn btn-light">
                        @else
                        <input type="submit" value="{{ __('Delete') }}" disabled class="btn btn-light">
                        @endif

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
        <a href="{{ route('admin') }}" class="btn btn-light mr-4">
            {{ __('Return') }}
        </a>

        <a href="{{ route('user_deleted') }}" class="btn btn-light">
            {{ __('Deleted') }}
        </a>
    </div>

</div>

@endsection
