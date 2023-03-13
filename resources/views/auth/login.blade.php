<!DOCTYPE html>
<html>
    <head>
        <title>Login || Cafe Reservation</title>
    </head>
    @include('layouts/navbar')
    <body>
        <div class="container">
            <div class="row justify-content-center" style="margin-top:4rem;">
                <div class="col-md-8 d-flex justify-content-center">
                    <div class="login">
                        <div class="login-header">
                            Login
                        </div>
                        <div class="login-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row mb-3 ">
                                    <div class="col-md-10">
                                        <div class="form-group" style="padding-left:100px;">
                                            <span class="fa fa-user form-control-icon"></span>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" placeholder="Email"  required autocomplete="email" autofocus style="border-radius:30px;">
                                        </div> 
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-10">
                                        <div class="form-group" style="padding-left:100px;">
                                            <span class="fa fa-lock form-control-icon"></span>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" style="border-radius:30px;">
                                            <div class="form-group-append">
                                                <span class="fa fa-eye form-control-icon" onclick="showPassword()"></span>
                                            </div>
                                            

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-3 pb-3">
                                        {{ __("Don't Have an Account ?") }} <a href="/register" style="color:blue; text-decoration:underline; cursor: pointer;">Sign Up</a>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-3">
                                        <button type="submit" class="btn button-login">
                                            <b style="letter-spacing:2px; margin: 0 20px 0 20px;">
                                                Login
                                            </b>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </body>
</html>

