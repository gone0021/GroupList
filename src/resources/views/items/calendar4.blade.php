@extends('layouts.cardapp')
@section('card')

    <div class="card-header" style="text-align: center;">
        - 予約 -
    </div>
    <div class="card-body">
        <ul>
            <li>カレンダーより、ご希望の予約日をお選びください。</li>
            <li>予約日は次回予約のみお取りいただけます。</li>
            <li>予約日時を変更される場合は、いったんキャンセルしてから予約をお取りなおしください。</li>
        </ul>


        <div class="calender">
            <form class="prev-next-form"></form>
            <table class="table">
                <tr>
                    <td colspan="2">
                        <button class="btn btn-outline-secondary prev-next-btn" data-month="{{ $month->add(-1, 'month')->format('Y-m') }}"><</button>
                    </td>
                    <th colspan="3">
                        <div class="text-center">
                            {{ $month->year }}年{{ $month->month }}月
                        </div>
                    </th>
                    <td colspan="2">
                        <div class="text-right">
                            <button class="btn btn-outline-secondary prev-next-btn" data-month="{{ $month->add(1, 'month')->format('Y-m') }}">></button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th class="sun"  style="color: red"><div class="text-center">日</div></th>
                    <th class="mon"><div class="text-center">月</div></th>
                    <th class="tue"><div class="text-center">火</div></th>
                    <th class="wed"><div class="text-center">水</div></th>
                    <th class="thu"><div class="text-center">木</div></th>
                    <th class="fri"><div class="text-center">金</div></th>
                    <th class="sat"  style="color: blue"><div class="text-center">土</div></th>
                </tr>

                @foreach ($calendar as $week)
                    <tr>
                        @foreach ($week as $date)
                            <td>
                                <div class="text-center">
                                    @if($date->date->weekDay() === 0)
                                        <span class="sun" style="color: red">{{ $date->date->day }}</span>
                                    @elseif($date->date->weekDay() === 6)
                                        <span class="sat" style="color:blue;">{{ $date->date->day }}</span>
                                    @else
                                        <span class="other">{{ $date->date->day }}</span>
                                    @endif
                                </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>

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