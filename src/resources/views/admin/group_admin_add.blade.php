@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Add Group Admin') }} :
    <span class="h5">{{ $group_name }}</span>
</div>

<div class="card-body">

    <table class="table">
        <tr>
            <th>
                <span class="mr-2">id</span>
                <a href="{{ url('admin/group_admin/add/sort_id_a') }}?group_id={{ $ses_group_id }}">↓</a>
                <a href="{{ url('admin/group_admin/add/sort_id_d') }}?group_id={{ $ses_group_id }}">↑</a>
            </th>
            <th>
                <span class="mr-2">ユーザー名</span>
                <a href="{{ url('admin/group_admin/add/sort_name_a') }}?group_id={{ $ses_group_id }}">↓</a>
                <a href="{{ url('admin/group_admin/add/sort_name_d') }}?group_id={{ $ses_group_id }}">↑</a>
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
                    {{-- 追加 --}}
                    <form action="{{ url('admin/group_admin/add') }}" method="post" class="float-left mr-3">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Add') }}" class="btn btn-light">
                    </form>
                </div>
            </td>
            @endforeach
        </tr>
    </table>


    <div>
        {{-- {{ $items->links() }} --}}
        {{ $items->appends(['group_id' => $ses_group_id])->links() }}
    </div>

    <div class="col-md-10">
        <a href="{{ url('admin/group_admin') }}?group_id={{ $ses_group_id }}" class="btn btn-light mr-4">
            {{ __('Return') }}
        </a>

    </div>

</div>

@endsection
