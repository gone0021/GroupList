@extends('layouts.cardapp')
@section('card')

<div class="card-header">{{__('Calendar')}}</div>

<div class="card-body">
    <div class="flex-center position-ref full-height">
        <div class="cld-content">

            <div>
                <a href="?ym={{ $prev }}" class="cld">&lt;</a>
                <span class="cld">{{ $month }}</span>
                <a href="?ym={{ $next }}" class="cld">&gt;</a>
            </div>

            <table class="table table-bordered">
                <tr>
                    @foreach ($titles as $title)
                    <th class="cld">{{$title}}</th>
                    @endforeach
                </tr>

                @foreach ($weeks as $week)
                {!! $week !!}
                @endforeach
            </table>

        </div>
        {{-- .content --}}
    </div>
    {{-- .flex-center .position-ref .full-height --}}
</div>
@endsection
