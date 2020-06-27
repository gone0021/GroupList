@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Group Admin')}} ：
    <span class="h5">{{ $group_name }}</span>
</div>

<div class="card-body">

    <table class="table">
        <tr>
            <th>
                <span class="mr-2">id</span>
                <a href="{{ url('admin/group_admin/sort_id_a') }}?group_id={{ $ses_group_id }}">↓</a>
                <a href="{{ url('admin/group_admin/sort_id_d') }}?group_id={{ $ses_group_id }}">↑</a>
            </th>
            <th>
                <span class="mr-2">管理者名</span>
                <a href="{{ url('admin/group_admin/sort_name_a') }}?group_id={{ $ses_group_id }}">↓</a>
                <a href="{{ url('admin/group_admin/sort_name_d') }}?group_id={{ $ses_group_id }}">↑</a>
            </th>
            <th>操作</th>
        </tr>

        @foreach ($items as $item)
        <tr class="">
            <td>
                {{ $item->id }}
            </td>
            <td>
                {{ $item->user_name }}
            </td>

            <td>
                <div>
                    {{-- 削除 --}}
                    <form action="{{ url('admin/group_admin/delete') }}" method="get" class="float-left mr-3">
                        <input type="hidden" name="user_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Delete') }}" class="btn btn-light">
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>

    <div>
        {{-- {{ $items->links() }} --}}
        {{ $items->appends(['group_id' => $ses_group_id])->links() }}
    </div>

    <div class="col-md-10">
        <a href="{{ url('admin/list') }}" class="btn btn-light mr-3 float-left">
            {{ __('Return') }}
        </a>

        {{-- 管理者の追加 --}}
        <form action="{{ url('admin/group_admin/add') }}" method="get">
            <input type="hidden" name="group_id" id="" value="{{ $ses_group_id }}">
            <input type="submit" value="{{ __('Add Admin') }}" class="btn btn-light">
        </form>

    </div>

</div>

@endsection
