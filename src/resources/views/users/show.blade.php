@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
          <table class="table table-hover col-md-10 offset-md-1">
            <tr class="">
              <th class="">ユーザー名</th>
              <td class="">{{ $item->user_name }}</td>
            </tr>

            <tr>
              <th class="">メールアドレス</th>
              <td class="">{{ $item->email }}</td>
            </tr>

            <tr>
              <th class="">誕生日</th>
              <td class="">{{ $item->birthday }}</td>
            </tr>
          </table>

          <div class="col-md-10 offset-md-2">
            <a href="{{ url('users/edit') }}" class="mr-3 btn btn-light">
            {{ __('Edit') }}
            </a>
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
