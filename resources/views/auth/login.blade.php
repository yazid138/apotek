@extends('layouts.app2', ['title' => 'Login'])

@push('style')
    <style>
        body {
            background: linear-gradient(to bottom right, #d3e5d2, #a7c5a6);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container img {
            width: 200px;
            height: auto;
            display: block;
            margin: 0 auto 15px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
        }
    </style>
@endpush

@section('content')
    <div class="login-container">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
        @error('failed')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @enderror
        <form class="mt-4" style="width: 300px" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <input class="form-control" id="username" type="text"
                    class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('email') }}"
                    required autocomplete="username" autofocus placeholder="username">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-block">{{ __('LOGIN') }}</button>
            </div>
        </form>
    </div>
@endsection
