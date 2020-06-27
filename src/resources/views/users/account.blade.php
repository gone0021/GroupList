@extends('layouts.cardapp')
@section('card')

<div class="card-header">{{ __('Edit Page') }}</div>

<div class="card-body">
    <p>
        <a href="{{ url('users/password') }}">
            パスワードの変更
        </a>
    </p>

    <p>
        <a href="{{ url('users/delete') }}">
            アカウントの削除
        </a>
    </p>

    <div class="col-md-10">

        <a href="{{ route('users') }}" class="btn btn-light">
            {{ __('Return') }}
        </a>
    </div>
</div>
@endsection
