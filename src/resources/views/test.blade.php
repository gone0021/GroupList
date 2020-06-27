@extends('layouts.cardapp')
@section('card')
<div class="card-header">Dashboard</div>

<div class="card-body">
    <p>
        <a href="{{ url('users') }}">
            home
        </a>
    </p>

    <button type="button" onclick="history.back()">戻る</button>
</div>

@endsection
