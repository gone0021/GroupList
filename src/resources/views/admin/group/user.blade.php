@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Add User')}} ：
    <span class="h5">{{ $group_name }}</span>
</div>

<div class="card-body">

    {{-- <table class="table"> --}}
    <table class="table table-hover col-md-10 offset-md-1">
        <tr>
            <th>id</th>
            <th>ユーザー名</th>
        </tr>

        @foreach ($items as $item)
        <tr class="">
            <td class="">
                {{ $item->id }}
            </td>
            <td class="">
                {{ $item->user_name }}
            </td>
        </tr>
        @endforeach
    </table>

    <div>
        {{-- {{ $items->links() }} --}}
        {{ $items->appends(['group_id' => $group_id])->links() }}
    </div>

    <div class="col-md-10 offset-md-1">
        @if (request()->url() == url('/admin/group/user') )
        <a href="{{ url('/admin/list') }}" class="btn btn-light">
            {{ __('Return') }}
        </a>
        @elseif (request()->url() == url('/group/user'))
        <a href="{{ route('group') }}" class="btn btn-light">
            {{ __('Return') }}
        </a>
        @endif

    </div>

</div>

@endsection
