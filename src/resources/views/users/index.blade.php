@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

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

                    @if (Auth::user()->is_admin == '1')
                    <p>
                        <a href="{{ route('admin') }}">
                            管理者画面
                        </a>
                    </p>
                    @endif


                    {{-- @if (Auth::user()->is_admin == '2') --}}
                    @if (Auth::user()->is_admin == '1')
                    <p>
                        <a href="{{ route('group') }}">
                            グループ管理
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

                    <p>
                        投稿一覧
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
