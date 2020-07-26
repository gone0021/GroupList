@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Edit Group')}}</div>

<div class="card-body">

    <table class="table">
        <tr>
            <th>
                <span class="mr-2">id</span>
                <a href="{{ url('admin/list/sort_id_a') }}">↓</a>
                <a href="{{ url('admin/list/sort_id_d') }}">↑</a>
            </th>
            <th>
                <span class="mr-2">グループ名</span>
                <a href="{{ url('admin/list/sort_name_a') }}">↓</a>
                <a href="{{ url('admin/list/sort_name_d') }}">↑</a>
            </th>
            <th>操作</th>
        </tr>

        @foreach ($items as $item)
        <tr>
            <td>
                {{ $item->id }}
            </td>
            <td>
                {{ $item->group_name }}
            </td>

            <td>
                <div>
                    {{-- 編集 --}}
                    <form action="{{ url('admin/edit') }}" method="get" class="float-left mr-3">
                        <input type="hidden" name="group_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Edit') }}" class="btn btn-light">
                    </form>

                    {{-- ユーザー一覧 --}}
                    <form action="{{ url('admin/group_admin') }}" method="get" class="float-left mr-3">
                        <input type="hidden" name="group_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Group Admin') }}" class="btn btn-light">
                    </form>

                    {{-- 削除 --}}
                    <form action="{{ url('admin/delete') }}" method="get" class="float-both">
                        <input type="hidden" name="group_id" value="{{ $item->id }}">

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
        <a href="{{ route('admin') }}" class="btn btn-light mr-3">
            {{ __('Return') }}
        </a>

        {{-- 削除済 --}}
        <a href="{{ route('group_deleted') }}" class="btn btn-light">
            {{ __('Deleted') }}
        </a>
    </div>

</div>

@endsection
