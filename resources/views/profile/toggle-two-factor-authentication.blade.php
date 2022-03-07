@extends('layouts.app')

@section('title')
{{ __('Toggle Two Factor Authentication') }}
@endsection

@section('content')
<h1 class="text-center display-5 my-5"><a href="{{ url('/') }}" class="text-decoration-none link-dark">{{ __("Forstrap") }}</a></h1>
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card mb-3">
            <div class="card-header text-center">@yield('title')</div>
            <div class="card-body">
            @if(auth()->user()->two_factor_confirmed)
                <form class="d-inline" action="{{route('two-factor.disable')}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" type="submit">Disable 2FA</button>
                </form>
            @elseif(auth()->user()->two_factor_secret)
                <p>
                    In order to validate Two Factor Authentication, please scan this QR code with Google Authenticator or Duo and enter the validation code below :
                </p>
                <div class="mb-4">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>
                <div class="row justify-content-center">
                    <form action="{{route('two-factor-authentication.confirm')}}" method="post">
                        @csrf
                        <label for="code" class="form-label">Code</label>
                        <div class="input-group mb-3">
                            <input class="form-control" id="code" type="text" name="code" required/>
                        <button class="btn btn-primary" type="submit">Validate 2FA</button>
                        </div>
                    </form>
                    <form class="d-block" action="{{route('two-factor-authentication.abort')}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="w-100 btn btn-danger" type="submit">Abort 2FA activation</button>
                    </form>
                </div>
            @else
                <form class="d-inline" action="/user/two-factor-authentication" method="post">
                    @csrf
                    <button class="btn btn-primary" type="submit">Activate 2FA</button>
                </form>
            @endif
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('home') }}">{{ __('Return to home page') }}</a>
            </div>
        </div>

        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('status'))
            <div class="alert alert-success">
                @if (session('status') == "two-factor-authentication-disabled")
                    {{ __('Two Factor Authentication has been disabled.') }}
                @elseif (session('status') == "two-factor-authentication-enabled")
                    {{ __('Two Factor Authentication has been enabled.') }}
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
