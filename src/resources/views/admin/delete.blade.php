@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __('Delete Group')}} ：
    <span class="h5">{{ $group_name }}</span>
</div>

<div class="card-body">
    <p class="text-md-center lead">
        {{ __('Group') }}
        "{{ $group_name }}"<br>
        {{ __('Do you really want to delete it?') }}
    </p>
    <div class="text-md-center lead">
        <div class="col-md-10">
            <a href="{{ url('admin/fort') }}" class="btn btn-light mr-3">
                {{ __('Delete') }}
            </a>

            <a href="{{ url('admin/list') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>
    </div>
</div>

@endsection
