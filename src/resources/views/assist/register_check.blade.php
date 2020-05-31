@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    {{-- <form method="POST" action="{{ route('register') }}"> --}}
                    <form method="POST" action="{{ url('register_add') }}">
                        @csrf

                        {{-- ユーザーネーム --}}
                        <div class="form-group row">
                            <label for="user_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-4 mt-2 mb-0">
                                <span>{{ $user_name }}</span>

                                <input id="user_name" type="hidden"
                                    class="form-control @error('user_name') is-invalid @enderror" name="user_name"
                                    value="{{ $user_name }}" required autocomplete="user_name" autofocus>

                            </div>
                        </div>

                        {{-- メールアドレス --}}
                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-4 mt-2">
                                <span>{{ $email }}</span>
                                <input id="email" type="hidden"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ $email }}" required autocomplete="email">

                            </div>
                        </div>

                        {{-- 誕生日 --}}
                        <div class="form-group row">
                            <label for="birthday"
                                class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>

                            <div class="col-md-6 mt-2">
                                <span>{{ $birthday }}</span>
                                <input id="birthday" type="hidden"
                                    class="form-control @error('email') is-invalid @enderror" name="birthday"
                                    value="{{ $birthday }}" required autocomplete="birthday">

                            </div>
                        </div>

                        {{-- パスワード --}}
                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6 mt-2">
                                <span>{{ $password }}</span>
                                <input id="password" type="hidden"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    value="{{ $password }}" required autocomplete="new-password">

                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
