@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

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
            </div>
        </div>
    </div>
</div>
@endsection
