@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Admin Page')}}</div>

<div class="card-body">

    @if (Auth::user()->is_admin == '1')
    <p>
        <a href="{{ url('admin/user') }}">
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
    @endif

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

@endsection
