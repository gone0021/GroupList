@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' New Group')}}</div>

<div class="card-body">

    <form method="post" action="{{ url('admin/create') }}">
        @csrf

        <div class="form-group row">
            {{-- グループ名 --}}
            <label for="group_name" class="col-md-4 col-form-label text-md-right">{{ __('Group Name') }}</label>

            <div class="col-md-6">
                <input id="group_name" type="text" class="form-control @error('group_name') is-invalid @enderror"
                    name="group_name" value="{{ old('group_name') }}" required autocomplete="group_name" autofocus>

                @error('group_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- グループタイプ --}}
        <div class="form-group row">
            <label for="group_type" class="col-md-4 col-form-label text-md-right">{{ __('Group Type') }}</label>

            <div class="col-md-6">
                <select name="group_type">
                    <option value="0" selected>なし</option>
                    <option value="1">ダイビング</option>
                </select>
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

@endsection
