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
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" placeholder="Email"  required autocomplete="email" autofocus style="border-radius:30px; background-color: #F0F0F0;">
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
                                        <div class="form-group" style="padding-left:100px; position: relative;">
                                            <span class="fa fa-lock form-control-icon"></span>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" style="border-radius:30px; background-color: #F0F0F0;">
                                            <span style="right: 10px;" class="fa fa-eye form-control-icon-show-password" onclick="showPassword()"></span>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-2 pb-3 text-center">
                                        <span style = "color: #ba9e7f">Don't Have an Account ?</span>
                                        <a href="/register" style="color: #D4B096; text-decoration:underline; cursor: pointer;">Sign Up</a>
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-2 text-center">
                                        <button type="submit" class="btn button-login">
                                            <b style="letter-spacing:2px; margin: 0 20px 0 20px; font-size: 20px;">
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

