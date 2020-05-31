@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <table class="table">
                        <tr>
                            <th>グループ名</th>
                            <th>操作</th>
                        </tr>
                        <tr class="">
                            <td class="">ユーザー名</td>
                            {{-- <td class="">{{ $item->email }}</td> --}}

                            <td>
                                {{-- 編集 --}}
                                @if (Auth::user()->is_admin == '1')
                                <a href="{{ url('admin/create') }}" class="btn btn-light mr-3">
                                    編集
                                </a>
                                @endif

                                {{-- ユーザーの追加 --}}
                                @if (Auth::user()->is_admin == '1' || Auth::user()->is_admin == '2')
                                <a href="{{ url('admin/create') }}" class="btn btn-light mr-3">
                                    ユーザー追加
                                </a>
                                @endif

                                {{-- 脱退 --}}
                                <a href="{{ url('admin/create') }}" class="btn btn-light">
                                    脱退
                                </a>

                            </td>

                        </tr>

                        <tr>
                            <th class="">メールアドレス</th>
                        </tr>

                    </table>

                    <div class="col-md-10">
                        <a href="{{ url('users') }}" class="btn btn-light">
                            {{ __('Return') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
