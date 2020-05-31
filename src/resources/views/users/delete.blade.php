@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <p class="text-md-center lead">
                        {{ __('Do you really want to delete it?') }}
                    </p>
                    <div class="text-md-center lead">
                        <div class="col-md-10">
                            <a href="{{ url('users/fort') }}" class="btn btn-light mr-3">
                                {{ __('Delete') }}
                            </a>

                            <a href="{{ url('users/account') }}" class="btn btn-light">
                                {{ __('Return') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
