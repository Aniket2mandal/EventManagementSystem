<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<link rel="stylesheet" href="{{asset('css/user/register.css')}}">
<body>

    <div class="nav">
        <div class="logo">
            <h1 style="margin:0;padding:0">Event Management System</h1>
        </div>
        <div class="lists">
            <a href="">Home</a>
            <a href="{{route('user.registerindex')}}">Register</a>
        </div>
    </div>
    <div class="card-header">{{ __('Register') }}</div>
    <form method="POST" action="{{route('user.register')}}">
        @csrf
        <label for="name" class="col">{{ __('Name') }}</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <label for="email" class="col">{{ __('Email Address') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <label for="password" class="col">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
            required autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="password-confirm" class="col">{{ __('Confirm Password') }}</label>

        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password">

        <button type="submit" class="btn">
            {{ __('Register') }}
        </button>

    </form>
<div class="account">
    Already have an account?   <a href="{{route('user.loginindex')}}">Login Now</a>
</div>

</body>
</html>

{{-- @endsection --}}
