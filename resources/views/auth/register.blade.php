<!DOCTYPE html>
<html>
    <head>
        <title>Register || Cafe Reservation</title>
    </head>
    @include('layouts/navbar')
    <body>
    <div class="container" style="padding-bottom:2.4%">
            <div class="row justify-content-center" style="margin-top:2rem;">
                <div class="col-sm-10 d-flex justify-content-center">
                    <div class="register">
                        <div class="register-header">
                            Register
                        </div>
                        <div class="register-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="col mb-2">
                                    <label for="name" class="row-md-4 row-form-label text-md-end">{{ __('Name') }}</label>

                                    <div class="row-md-3">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="border-radius:30px; background-color: #F0F0F0;">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col mb-2">
                                    <label for="username" class="row-md-4 row-form-label text-md-end">{{ __('Username') }}</label>

                                    <div class="row-md-3">
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus style="border-radius:30px; background-color: #F0F0F0;">

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col mb-2">
                                    <label for="email" class="row-md-4 row-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="row-md-3">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="border-radius:30px; background-color: #F0F0F0;">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col mb-2">
                                    <label for="password" class="row-md-4 row-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="row-md-3 mb-3">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="border-radius:30px; background-color: #F0F0F0;">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-8 offset-md-2 text-center">
                                        <button type="submit" class="btn button-login">
                                            <b style="letter-spacing:2px; margin: 0 20px 0 20px; font-size: 20px;">
                                                Sign Up
                                            </b>
                                        </button>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-2 pb-3 text-center">
                                        <span style = "color: #ba9e7f">Already Have an Account ?</span>
                                        <a href="/login" style="color: #D4B096; text-decoration:underline; cursor: pointer;">Login</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        @include('layouts/footer2')
    </body>
</html>