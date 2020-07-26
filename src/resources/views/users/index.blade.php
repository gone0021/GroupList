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
        <a href="{{ url('calendar') }}">
            {{-- <a href="{{ url('users/group') }}"> --}}
            カレンダー表示
        </a>
    </p>

    <div>
        <span>
            新規投稿
        </span>

        <form action="" method="GET" class="mt-1 mb-3">
            <select name="is_open" class="mr-2">
                <option value="0">ダイビング</option>
                <option value="1">場所</option>
                <option value="2">予定</option>
            </select>

            <input type="submit" name="new" id="" value="new">
        </form>
    </div>

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
