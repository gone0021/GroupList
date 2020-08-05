@extends('layouts.cardapp')

@section('card')

<div class="card">
    <div class="card-header">{{ __(' Item Type') }}</div>

    <div class="card-body">

        <table class="table">
            <tr>
                <th>ジャンル</th>
                <th>操作</th>
            </tr>

            @empty(!$dive)
            <tr>
                <td>ダイビング</td>
                <td>
                    <form action="{{ url('divelogs') }}" method="get">
                        <input type="hidden" name="item_type" value="1">

                        <input type="submit" value="{{ __('Items') }}" class="btn btn-light">
                    </form>
                </td>
            </tr>
            @endempty

            @empty(!$trip)
            <tr>
                <td>場所</td>
                <td>
                    <form action="{{ url('trips') }}" method="get">
                        <input type="hidden" name="item_type" value="2">

                        <input type="submit" value="{{ __('Items') }}" class="btn btn-light">
                    </form>
                </td>
            </tr>
            @endempty

            @empty(!$plan)
            <tr>
                <td>予定</td>
                <td>
                    <form action="{{ url('plans') }}" method="get">
                        <input type="hidden" name="item_type" value="3">

                        <input type="submit" value="{{ __('Items') }}" class="btn btn-light">
                    </form>
                </td>
            </tr>
            @endempty

        </table>

        <div class="col-md-10">
            <a href="{{ route('users') }}" class="btn btn-light">
                {{ __('Return') }}
            </a>
        </div>

    </div>
</div>

@endsection
