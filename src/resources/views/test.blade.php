@extends('layouts.usersapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <p>
                        <a href="{{ url('users_show') }}">
                            ユーザー情報
                        </a>
                    </p>

                    <p>
                        グループ編集
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
