@extends('layouts.cardapp')
@section('card')
<div class="card-header">
    {{ __(' Item List')}} ：
    <span class="h5">{{ $group['group_name'] }}</span>
</div>

<div class="card-body">

    <table class="table">
        <tr>
            <th>
                <span class="mr-2">{{ __('Type') }}</span>
                {{-- <a href="{{ url('trips/sort_title_a') }}?item_type=1">↓</a>
                <a href="{{ url('trips/sort_title_d') }}?item_type=1">↑</a> --}}
            </th>

            <th>
                <span>{{ __('Title') }}</span>
            </th>

            <th>
                <span class="mr-2">{{ __('Date')}}</span>
                {{-- <a href="{{ url('trips/sort_date_a') }}?item_type=1">↓</a>
                <a href="{{ url('trips/sort_date_d') }}?item_type=1">↑</a>
            </th> --}}

            <th>
                <span>{{ __('User') }}</span>
            </th>

            <th>
                <span>
                    {{ __('Stasut')}}
                </span>
            </th>

        </tr>

        @foreach ($items as $item)
        <tr>

            {{-- item_type --}}
            <td>
                @if ($item->item_type == 1)
                ダイビング
                @elseif ($item->item_type == 2)
                場所
                @elseif ($item->item_type == 3)
                予定
                @else
                ???
                @endif
            </td>

            {{-- タイトル --}}
            @if ($item->is_open != 0)
            <td>
                @if ($item->item_type == 1)
                <a href="{{ url('divelogs/detail') }}?id={{ $item->item_id }}">{{ $item->title }}</a>

                @elseif ($item->item_type == 2)
                <a href="{{ url('trips/detail') }}?id={{ $item->item_id }}">{{ $item->title }}</a>

                @elseif ($item->item_type == 3)
                <a href="{{ url('plans/detail') }}?id={{ $item->item_id }}">{{ $item->title }}</a>

                @endif
            </td>

            @else
            <td>
                {{ $item->title }}
            </td>

            @endif


            {{-- 日付 --}}
            <td>
                {{ date('y年m月d日', strtotime($item->date)) }}
            </td>


            {{-- user名 --}}
            <td>
                {{ $item->user_name }}
            </td>

            {{-- 状態 --}}
            <td>
                @if ($item->status == 99)
                ログ
                @elseif ($item->status != 0)
                完了
                @else
                未完
                @endif
            </td>

            @endforeach
        </tr>
    </table>


    <div>
        {{-- group_idでwhereをしているためappendsでクエリに表示する --}}
        {{ $items->appends(['group_id' => $gid])->links() }}
    </div>

    <div class="col-md-10">
        <a href="{{ route('calendar') }}" class="btn btn-light mr-3">
            {{ __('Return') }}
        </a>
    </div>

</div>

@endsection
