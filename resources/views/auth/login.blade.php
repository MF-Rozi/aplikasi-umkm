@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                <img class="mb-4" src="{{ asset('frontend/assets/img/favicon.png') }}" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            </div>
            <div class="card-body">
                <main class="form-signin">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-floating">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="email">Email address</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-floating">

                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                            <label for="password">Password</label>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row text">
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- @if (Route::has('password.request'))
                        <a class="w-100 btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                        </a>
                        @endif --}}
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

                    </form>
                </main>
            </div>
        </div>
    </div>
</div>
@endsection
