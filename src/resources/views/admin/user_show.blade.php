@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Show User')}} ：
    <span class="h5">{{ $user_name }}</span>
</div>

<div class="card-body">
    <table class="table table-hover col-md-10 offset-md-1">
        <tr class="">
            <th class="">ユーザー名</th>
            <td class="">{{ $items->user_name }}</td>
        </tr>

        <tr>
            <th class="">メールアドレス</th>
            <td class="">{{ $items->email }}</td>
        </tr>

        <tr>
            <th class="">誕生日</th>
            <td class="">{{ $items->birthday }}</td>
        </tr>
    </table>

    <div class="col-md-10 offset-md-1">
        <a href="{{ url('admin/user') }}" class="btn btn-light">
            {{ __('Return') }}
        </a>
    </div>
</div>

@endsection
