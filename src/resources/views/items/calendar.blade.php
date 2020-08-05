@extends('layouts.cardapp')
@section('card')

<form action="{{ url('calendar') }}" method="GET" class="float-left">
    <div class="card-header">{{__('Calendar')}}
        <input type="hidden" name="ym" value="{{$dispMonth}}">

        <span class="ml-5">グループ：</span>
        <select name="group_id" class="">
            <option value="0">個人</option>

            @foreach ($groups as $v)
            <option value="{{$v->id}}" @if ($group_id == $v->id) selected @endif>
                {{ $v->group_name }}
            </option>
            @endforeach
        </select>

        <span class="ml-4">投稿種別：</span>
        <select name="item_type">
            @for ($i = 0; $i < count($lists); $i++)
            <option value="{{ $i }}" @if ($item_type == $i) selected @endif>
            {{ $lists[$i] }}
            </option>
            @endfor
        </select>

        <input type="submit" value="表示" class="btn btn-light ml-3">
    </div>
</form>

<div class="card-body">
    <div class="flex-center position-ref">
        <div class="cld-content">

            <div>
                <a href="?ym={{ $prev }}&group_id={{ $group_id }}&item_type={{ $item_type }}" class="cld mr-2">&lt;</a>

                <span class="cld mr-2">{{ $month }}</span>

                <a href="?ym={{ $next }}&group_id={{ $group_id }}&item_type={{ $item_type }}" class="cld mr-4">&gt;</a>

                <a href="?ym={{ $thisMonth }}&group_id={{ $group_id }}&item_type={{ $item_type }}" class="cld this-month"> &nbsp; 今月 </a>
            </div>

            <table class="table table-bordered">
                <tr>
                    @foreach ($titles as $v)
                    <th class="cld">{{$v}}</th>
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

    <div class="col-md-10">
        <a href="{{ route('users') }}" class="btn btn-light mr-3">
            {{ __('Return') }}
        </a>
    </div>

</div>
@endsection
