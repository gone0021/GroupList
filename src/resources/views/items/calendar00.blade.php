@extends('layouts.cardapp')
@section('card')
<div class="card-header">
    {{ __(' Item List')}} ：
    <span class="h5">{{ $group->group_name }}</span>
</div>

<div class="card-body">

    <table class="table table-bordered">
        <thead>
            <tr>
                @foreach (['日', '月', '火', '水', '木', '金', '土'] as $dayOfWeek)
                <th>{{ $dayOfWeek }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($dates as $date)
            @if ($date->dayOfWeek == 0)
            <tr>
                @endif
                <td @if ($date->month != $currentMonth)
                    class="bg-secondary"
                    @endif
                    >
                    {{ $date->day }}
                </td>
                @if ($date->dayOfWeek == 6)
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>

    <div class="col-md-10">
        <a href="{{ route('item_group') }}" class="btn btn-light mr-3">
            {{ __('Return') }}
        </a>
    </div>
</div>