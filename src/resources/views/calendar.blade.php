@extends('layouts.cardapp')
@section('card')

<div class="card-header">{{__('Calendar')}}</div>

<div class="col s12 offset-l1 l8">
    <nav class="header">
        <a href="#" data-target="slide-out" class="sidenav-trigger btn-floating"><i
                class="medium z-depth-1 material-icons">add</i></a>
        <h2 class="center-align">案件納期カレンダー</h2>
    </nav>
    {!! $cal_tag !!}
</div>
</div>
@endsection
