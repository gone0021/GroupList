@extends('layouts.cardapp')
@section('card')
<div class="card-header">{{ __(' Trip List')}}</div>

<div class="card-body">
    {{-- item_type --}}
    <div class="form-group row">
        <input type="hidden" name="item_type" value="{{ $ses_item_type }}">
    </div>

    {{-- trip_title --}}
    <div class="form-group row">
        <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

        <div class="col-md-6">
            <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror"
                name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>

            @error('user_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    {{-- date --}}
    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    {{-- point_name --}}
    <div class="form-group row">
        <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('POint Name') }}</label>

        <div class="col-md-6">
            <input id="birthday" type="date" class="form-control @error('email') is-invalid @enderror" name="birthday"
                value="{{ old('birthday') }}" required autocomplete="birthday">

            @error('birthday')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    {{-- is_went --}}
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    {{-- map_item --}}
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Map') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    {{-- <tr>
        <th scope="row" class="pt-4">マップ</th>
        <td class="align-l ggmap">
          <!-- バリデーション -->
          <?php if (isset($_SESSION['msg']['map_item'])) : ?>
            <p class="error"><?= $_SESSION['msg']['map_item'] ?></p>
          <?php endif ?>
          <!-- SESSIONされたマップ情報の取得 -->

          <!-- 入力フォーム -->
          <!-- googlemapから位置情報を取得するためsessionを取らずvalueを入れない（URLを埋め込む意味がない） -->
          <input type="text"  name="map_item" id="map_item" class="form-control">
          <p><a href="https://www.google.co.jp/maps/" target="blank">GoogleMap</a>から「共有→地図を埋め込む」のURLを貼り付けてください</p>
        </td>
      </tr> --}}

    {{-- comment --}}
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    {{-- open_range --}}
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Range') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    {{-- is_open --}}
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Open') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


    <div>
        {{-- {{ $items->links() }} --}}
    </div>

    <div class="col-md-10">
        <a href="{{ route('users') }}" class="btn btn-light mr-3">
            {{ __('Return') }}
        </a>
    </div>



</div>

@endsection
