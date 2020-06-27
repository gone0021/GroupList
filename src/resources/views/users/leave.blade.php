@extends('layouts.cardapp')
@section('card')

<div class="card-header">{{ __('Leave Group') }}</div>
<div class="card-body">

    <p class="text-md-center lead">

        グループ "{{ $group_name }}"を

        {{ __('Are you sure you want to leave?') }}
    </p>
    <div class="text-md-center lead">
        <div class="col-md-10">

            <form action="{{ url('users/leave') }}" method="post">
                @csrf
                <input type="hidden" name="group_id" value="{{ $id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <input type="submit" name="" id="" value="{{ __('Leave') }}" class="btn btn-light mr-3">


                <a href="{{ url('users/group') }}" class="btn btn-light">
                    {{ __('Return') }}
                </a>
            </form>

        </div>
    </div>
</div>
@endsection
