@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <p class="text-md-center lead">

                        グループ "
                        {{ $group_name }}
                        "を

                        {{ __('Are you sure you want to leave?') }}
                    </p>
                    <div class="text-md-center lead">
                        <div class="col-md-10">

                            <form action="{{ url('users/leave') }}" method="post">
                                <input type="submit" name="" id="" value="{{ __('Leave') }}" class="btn btn-light mr-3">


                                <a href="{{ url('users/group') }}" class="btn btn-light">
                                    {{ __('Return') }}
                                </a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
