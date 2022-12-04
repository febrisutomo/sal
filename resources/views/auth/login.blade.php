@extends('layouts.auth')

@section('title')
    PT SAL - Login
@endsection

@section('content')
    <form action="{{ route('login') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="form-group form-show-validation @error('email') has-error @enderror">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="la la-envelope"></i></span>
                </div>
                <input id="email" type="email" class="form-control" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan Email">

                
            </div>
            @error('email')
                    <label class="mt-1">
                        {{ $message }}
                    </label>
                @enderror
        </div>
        <div class="form-group form-show-validation @error('password') has-error @enderror">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="la la-key"></i></span>
                </div>
                <input id="password" type="password" class="form-control "
                    name="password" required autocomplete="current-password" placeholder="Masukkan Password">

            </div>
            @error('password')
            <label class="mt-1">
                {{ $message }}
            </label>
        @enderror
        </div>
        <div class="row form-sub m-0">
            <div class="col col-md-6">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="rememberme" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="rememberme">Ingat Saya</label>
                </div>
            </div>
            {{-- <div class="col col-md-6 login-forget">
            <a href="#" class="link">Lupa password ?</a>
        </div> --}}
        </div>
        <div class="form-action">
            <button type="submit" class="btn btn-primary btn-rounded btn-login"><span class="btn-label"><i
                        class="la la-sign-in"></i> LOGIN</span></button>
        </div>
    </form>
@endsection
