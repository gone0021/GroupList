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
                                {{-- ユーザーの追加 --}}
                                <a href="{{ url('admin/create') }}" class="btn btn-light mr-3">
                                    ユーザー追加
                                </a>

                            </td>

                        </tr>

                        <tr>
                            <th class="">メールアドレス</th>
                        </tr>

                    </table>

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
