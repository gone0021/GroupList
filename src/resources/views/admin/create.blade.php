@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <form method="post" action="{{ url('admin/create') }}">
                        @csrf

                        {{-- グループ作成 --}}
                        <div class="form-group row">
                            <label for="group_name" class="col-md-4 col-form-label text-md-right">{{ __('Group Name') }}</label>

                            <div class="col-md-6">
                                <input id="group_name" type="text" class="form-control @error('group_name') is-invalid @enderror" name="group_name" value="{{ old('group_name') }}" required autocomplete="group_name" autofocus>

                                @error('group_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-10 offset-md-2">
                            <input type="submit" value="{{ __('Do') }}" class="mr-3 btn btn-light">

                            <a href="{{ route('admin') }}" class="btn btn-light">
                                {{ __('Return') }}
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
