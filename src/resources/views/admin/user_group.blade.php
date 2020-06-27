@extends('layouts.cardapp')
@section('card')
<div class="card-header">
    {{ __(' Participating Group List') }} ：
    <span class="h5">{{ $user_name }}</span>
</div>

<div class="card-body">

    <table class="table table-hover col-md-10 offset-md-1">
        <tr>
            <th>グループ名</th>
        </tr>

        @foreach ($items as $item)
        <tr class="">
            <td class="">
                {{ $item->group_name }}
            </td>
        </tr>
        @endforeach
    </table>

    <div class="col-md-10 offset-md-1">
        <a href="{{ url('admin/user') }}" class="btn btn-light">
            {{ __('Return') }}
        </a>
    </div>

</div>

@endsection
