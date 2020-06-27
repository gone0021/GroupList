@extends('layouts.cardapp')
@section('card')

<div class="card-header">Home</div>

<div class="card-body">
    <p>
        <a href="{{ url('users/show') }}">
            ユーザー情報
        </a>
    </p>

    <p>
        <a href="{{ url('users/account') }}">
            パスワードの変更・アカウントの削除
        </a>
    </p>

    @if (Auth::user()->is_admin == '1' || Auth::user()->is_admin == '2')
    <p>
        <a href="{{ route('admin') }}">
            管理者画面
        </a>
    </p>
    @endif

    <p>
        <a href="{{ url('users/group') }}">
            参加グループ一覧
        </a>
    </p>

    <p>
        カレンダー表示
    </p>

    <div>
        投稿一覧
    </div>

    <ul class="list-unstyled ml-3">
        <li class="my-2">
            <a href="{{ url('users/item/list') }}">
                    個人投稿一覧
            </a>
        </li>

        <li class="my-2">
            <a href="{{ url('users/item/group') }}">
                グループ別
            </a>
        </li>
    </ul>

</div>
@endsection
