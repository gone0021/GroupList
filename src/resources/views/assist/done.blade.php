@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>


                <div class="card-body">
                    <p class="text-md-center lead">{{ $msg }}</p>

                    <div class="text-md-center lead">
                        <a href="{{ $link }}">{{ $disp }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
