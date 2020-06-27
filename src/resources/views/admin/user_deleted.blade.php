@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Deleted User List')}}</div>

<div class="card-body">

    <table class="table">
        <tr>
            <th>
                <span class="mr-2">id</span>
                <a href="{{ url('admin/user/deleted/sort_id_a') }}">↓</a>
                <a href="{{ url('admin/user/deleted/sort_id_d') }}">↑</a>
            </th>
            <th>
                <span class="mr-2">ユーザー名</span>
                <a href="{{ url('admin/user/deleted/sort_name_a') }}">↓</a>
                <a href="{{ url('admin/user/deleted/sort_name_d') }}">↑</a>
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
                    {{-- 復元 --}}
                    <form action="{{ url('admin/user/deleted') }}" method="post" class="float-left mr-3">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $item->id }}">

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
        <a href="{{ url('admin/user') }}" class="btn btn-light">
            {{ __('Return') }}
        </a>
    </div>

</div>

@endsection
