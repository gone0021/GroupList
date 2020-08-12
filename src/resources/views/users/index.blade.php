@extends('layouts.cardapp')
@section('card')

<div class="card-header">Home</div>

<div class="card-body">
    <p>
        <a href="{{ url('users/account') }}">
            アカウント設定
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
        <form action="{{ url('users/new') }}" method="GET" class="mt-1 mb-3">
            <label for="new" class="">{{ __('Make new items') }}</label>
            <br>
            <select name="new" id="new" class="mr-3 ml-3">
                <option value="0">ダイビング</option>
                <option value="1">場所</option>
                <option value="2">予定</option>
            </select>

            <input type="submit" name="" id="" value="new" class="btn btn-light">
        </form>
    </div>

    <div>
        {{ __('Item list')}}
    </div>

    <ul class="list-unstyled ml-3">
        <li class="my-2">
            <a href="{{ url('users/item/list') }}">
                個人
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
