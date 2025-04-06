@extends('layouts.auth')

@section('content')
    <div class="form login">
        <div class="form-content">
            <header>Login</header>
            <form action="{{ route('loginAuth') }}" method="POST">
                @csrf
                <div class="field input-field">
                    <input type="email" placeholder="Email" class="input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="field input-field">
                    <input type="password" placeholder="Password" class="password form-control @error('password') is-invalid @enderror" name="password">
                    <i class='bx bx-hide eye-icon'></i>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                {{-- <div class="form-link">
                    <a href="#" class="forgot-pass">Forgot password?</a>
                </div> --}}
                <div class="field button-field">
                    <button type="submit">Login</button>
                </div>
            </form>
            <div class="form-link">
                <span>Don't have an account? <a href="{{route('register')}}" class="link signup-link">Signup</a></span>
            </div>
        </div>
        <div class="line"></div>
        <div class="media-options">
            <a href="#" class="field facebook">
                <i class='bx bxl-facebook facebook-icon'></i>
                <span>Login with Facebook</span>
            </a>
        </div>
        <div class="media-options">
            <a href="#" class="field google">
                <img src="https://cdn-icons-png.flaticon.com/128/2702/2702602.png" alt="" class="google-img">
                <span>Login with Google</span>
            </a>
        </div>
    </div>


@endsection
