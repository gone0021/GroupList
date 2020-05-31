@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <p>
                        {{-- <a href="{{ url('admin/user') }}"> --}}
                            ユーザーリスト
                        </a>
                    </p>

                    <p>
                        <a href="{{ url('admin/create') }}">
                            グループの作成
                        </a>
                    </p>

                    <p>
                        <a href="{{ url('admin/list') }}">
                            グループの編集
                        </a>
                    </p>

                    <p>
                        <a href="{{ url('group') }}">
                        ユーザーの追加
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
