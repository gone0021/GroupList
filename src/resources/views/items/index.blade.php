@extends('layouts.cardapp')
@section('card')
<div class="card-header">
    {{ __(' Item List')}} ：
    <span class="h5">{{ $group['group_name'] }}</span>
</div>

<div class="card-body">

    <table class="table" id="tb-item">
        <thead>
            <tr>
                <th>
                    <span class="mr-2">{{ __('Type') }}</span>
                    <a href="{{ url('groupitem/sort_type_a') }}?group_id={{ $gid }}">↓</a>
                    <a href="{{ url('groupitem/sort_type_b') }}?group_id={{ $gid }}">↑</a>
                </th>

                <th>
                    <span>{{ __('Title') }}</span>
                </th>

                <th>
                    <span class="mr-2">{{ __('Date')}}</span>
                    <a href="{{ url('groupitem/sort_date_a') }}?group_id={{ $gid }}">↓</a>
                    <a href="{{ url('groupitem/sort_date_b') }}?group_id={{ $gid }}">↑</a>
                </th>

                <th>
                    <span class="">{{ __('User') }}</span>
                </th>

                <th>
                    <span>
                        {{ __('Stasut')}}
                    </span>
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($items as $item)
            <tr>
                <td id="type">
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

                @if ($item->is_open != 0)
                <td id="title">
                    @if ($item->item_type == 1)
                    <a href="{{ url('divelogs/detail') }}?id={{ $item->item_id }}">{{ $item->title }}</a>

                    @elseif ($item->item_type == 2)
                    <a href="{{ url('trips/detail') }}?id={{ $item->item_id }}">{{ $item->title }}</a>

                    @elseif ($item->item_type == 3)
                    <a href="{{ url('plans/detail') }}?id={{ $item->item_id }}">{{ $item->title }}</a>
                    @endif
                </td>

                @else
                <td id="title">
                    {{ $item->title }}
                </td>
                @endif


                {{-- 日付 --}}
                <td id="date">
                    {{ date('y年m月d日', strtotime($item->date)) }}
                </td>


                {{-- user名 --}}
                <td id="name">
                    {{ $item->user_name }}
                </td>

                {{-- 状態 --}}
                <td id="status">
                    @if ($item->status == 99)
                    ログ
                    @elseif ($item->status != 0)
                    完了
                    @else
                    予定
                    @endif
                </td>

                @endforeach
            </tr>
        </tbody>
    </table>


    <div>
        {{-- group_idでwhereをしているためappendsでクエリに表示する --}}
        {{ $items->appends(['group_id' => $gid])->links() }}
    </div>

    <div class="col-md-10">
        <a href="{{ route('item_group') }}" class="btn btn-light mr-3">
            {{ __('Return') }}
        </a>
    </div>

</div>

@endsection
