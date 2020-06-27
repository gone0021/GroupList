@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Delete Group Admin') }} :
    <span class="h5">{{ $group_name }}</span>
</div>

<div class="card-body">
    <p class="text-md-center lead">
        {{ __('Admin') }}
        "{{ $user->user_name }}"<br>
        {{ __('Do you really want to delete it?') }}
    </p>
    <div class="text-md-center lead">
        <div class="col-md-10">
            <form action="{{ url('admin/group_admin/delete') }}" method="post">
                @csrf
                <input type="hidden" name="group_id" id="" value="{{ $ses_group_id }}">
                <input type="hidden" name="user_id" id="" value="{{ $user_id }}">

                <input type="submit" value="{{ __('Delete') }}" class="btn btn-light mr-3">

                <a href="{{ url('admin/list') }}" class="btn btn-light">
                    {{ __('Return') }}
                </a>
            </form>
        </div>
    </div>
</div>

@endsection
