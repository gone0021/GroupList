@extends('layouts.cardapp')

@section('card')

<div class="card">
    <div class="card-header">Dashboard</div>

    <div class="card-body">

        @if ($items != null)
        <table class="table">
            <tr>
                <th>グループ名</th>
                <th>操作</th>
            </tr>

            @foreach ($items as $item)
            {{-- @if ($item->id != null) --}}
            <tr class="">
                <td class="">
                    {{ $item->group_name }}
                </td>

                <td>
                    <form action="{{ url('users/leave') }}" method="get">
                        <input type="hidden" name="group_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Leave') }}" class="btn btn-light">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <p>参加しているグループはありません</p>
        @endif

        <div class="col-md-10">
            <a href="{{ route('users') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>

    </div>
</div>

@endsection
