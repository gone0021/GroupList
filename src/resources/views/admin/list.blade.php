@extends('layouts.cardapp')
@section('card')
<div class="card-header">Dashboard</div>

<div class="card-body">

    <table class="table">
        <tr>
            <th>
                <span class="mr-2">id</span>
                <a href="/admin/list?sort=id" >↓</a>
                <a href="/admin/list?sort=id_de">↑</a>
            </th>
            <th>
                <span class="mr-2">グループ名</span>
                <a href="/admin/list?sort=name" >↓</a>
                <a href="/admin/list?sort=name_de">↑</a>
            </th>
            <th>操作</th>
        </tr>
        @foreach ($items as $item)
        {{-- @if ($item->id != null) --}}
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

                    {{-- ユーザーの追加 --}}
                    <form action="{{ url('admin/edit') }}" method="get" class="float-left mr-3">
                        <input type="hidden" name="group_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Add User') }}" class="btn btn-light">
                    </form>

                    {{-- 削除 --}}
                    <form action="{{ url('admin/edit') }}" method="get" class="float-both">
                        <input type="hidden" name="group_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Delete') }}" class="btn btn-light">
                    </form>

                </div>
            </td>
            @endforeach
        </tr>
    </table>


<div>
    {{ $items->appends(['sort' => $sort])->links() }}
    {{-- {{ $items->links() }} --}}
</div>

<div class="col-md-10">
        <a href="{{ route('admin') }}" class="btn btn-light">
            {{ __('Return') }}
        </a>
    </div>

</div>

@endsection
