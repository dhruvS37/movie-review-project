@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-6 border rounded-2 my-3 p-3">

                <h2 class="text-bg-dark border rounded-2 text-center p-1 mb-3">Reset Password</h2>


                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

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
                        <button type="submit" class="btn btn-dark">
                            Send Password Reset Link
                        </button>
                    </div>

                </form>

                @if (Session::has('resetLink'))
                <div class=" container alert alert-success alert-box">
                    {{ Session::get('resetLink') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
