@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Add User')}} ：
    <span class="h5">{{ $group_name }}</span>
</div>

<div class="card-body">

    {{-- <table class="table"> --}}
    <table class="table table-hover col-md-10 offset-md-1">
        <tr>
            <th>
                <span class="mr-2">id</span>
                <a href="{{ url('group/user/sort_id_a') }}?group_id={{ $ses_group_id }}">↓</a>
                <a href="{{ url('group/user/sort_id_d') }}?group_id={{ $ses_group_id }}">↑</a>
            </th>

            <th>
                <span class="mr-2">ユーザ名</span>
                <a href="{{ url('group/user/sort_name_a') }}?group_id={{ $ses_group_id }}">↓</a>
                <a href="{{ url('group/user/sort_name_d') }}?group_id={{ $ses_group_id }}">↑</a>
            </th>

            @if (Auth::user()->is_admin == 1)
            <th>操作</th>
            @endif
        </tr>

        @foreach ($items as $item)
        <tr class="">
            <td class="">
                {{ $item->id }}
            </td>
            <td class="">
                {{ $item->user_name }}
            </td>
            <td>
                {{-- 削除（マスターのみ） --}}
                @if (Auth::user()->is_admin == 1)
                <form action="{{ url('group/user/delete') }}" method="post" class="float-left mr-3">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $item->id }}">

                    @if (Auth::user()->is_admin !== $item->is_admin)
                    <input type="submit" value="{{ __('Delete') }}" class="btn btn-light">
                    @else
                    <input type="submit" value="{{ __('Delete') }}" disabled class="btn btn-light">
                    @endif


                    {{-- <input type="submit" value="{{ __('Delete') }}" class="btn btn-light"> --}}
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>

    <div>
        {{-- {{ $items->links() }} --}}
        {{ $items->appends(['group_id' => $ses_group_id])->links() }}
    </div>

    <div class="col-md-10">
        <a href="{{ route('group') }}" class="btn btn-light mr-4">
            {{ __('Return') }}
        </a>

    </div>

</div>

@endsection
