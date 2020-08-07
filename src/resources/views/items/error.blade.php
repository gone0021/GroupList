@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' ERROR')}}</div>

<div class="card-body">
    <p class="text-md-center lead">
        {{ __('Not in the group.') }}
    </p>
    <div class="text-md-center lead">
        <div class="col-md-10">
            <a href="{{ route('users') }}" class="btn btn-light mr-3">
                {{ __('Home') }}
            </a>
        </div>
    </div>
</div>

@endsection
