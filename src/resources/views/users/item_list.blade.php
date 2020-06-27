@extends('layouts.cardapp')

@section('card')

<div class="card">
    <div class="card-header">{{ __('Participating Group List') }}</div>

    <div class="card-body">

        <table class="table">
            <tr>
                <th>ジャンル</th>
                <th>操作</th>
            </tr>

            @foreach ($items as $item)
            <tr class="">
                <td class="">
                    {{ $item->item_type }}
                </td>

                <td>
                    <form action="{{ url('users/leave') }}" method="get">
                        <input type="hidden" name="group_id" value="{{ $item->id }}">

                        <input type="submit" value="{{ __('Items') }}" class="btn btn-light">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        <div class="col-md-10">
            <a href="{{ route('users') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>

    </div>
</div>

@endsection
