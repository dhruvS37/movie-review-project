@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-6 border rounded-2 my-3 p-3">
                <h2 class="text-bg-dark border rounded-2 text-center p-1 mb-3">Login</h2>

                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                            id="email" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" required
                            autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" id="emailHelp">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                            id="password" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-dark">
                            Login
                        </button>

                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
