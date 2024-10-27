{{-- @extends('layouts.app')

@section('content') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <link rel="stylesheet" href="{{ asset('css/user/login.css') }}">


    <div class="error">
        @if (session('error'))
            <div class='container'>{{ session('error') }}</div>
        @endif
    </div>
    <div class="success">
        @if (session('success'))
            <div class='container'>{{ session('success') }}</div>
        @endif
    </div>
    {{-- @include('admin.message') --}}
    {{-- <h1>Admin Login</h1> --}}
    <div class="card">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
            <form method="POST" action="{{route('user.login')}}">
                @csrf


                <label for="email" class="col">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"name="email" value="" autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror




                <label for="password" class="col">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror




                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>



                <div class="col">
                    <button type="submit" class="btn ">
                        {{ __('Login') }}
                    </button><br>

                    {{-- @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif --}}
                </div>
            </form>
            <div class="account">
                Didn't have an account? <a href="{{route('user.registerindex')}}">Sign Up</a>
            </div>
        </div>
    </div>

    </div>
    </div>



</body>

</html>
