@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-6 border rounded-2 my-3 p-3">
                <h2 class="text-bg-dark border rounded-2 text-center p-1 mb-3">Register</h2>

                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>

                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                            id="name" name="name" aria-describedby="nameHelp" value="{{ old('name') }}" required
                            autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" id="nameHelp">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                            id="email" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" required>
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

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                            id="password-confirm" name="password_confirmation" required>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-dark">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
