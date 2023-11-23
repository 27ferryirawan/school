<!DOCTYPE html>
<html>

<head>
    <title>Login || Cafe Reservation</title>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
</head>
@include('layouts/admin_navbar')

<body>
    <div class="container" style="padding-bottom:2.4%;">
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
                                <div class="col-md-10 offset-md-1">
                                    <div class="form-group">
                                        <span class="fa fa-user form-control-icon"></span>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror " name="email"
                                            value="{{ old('email') }}" placeholder="Email" required
                                            autocomplete="email" autofocus style="background-color: #F0F0F0;">
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-10 offset-md-1">
                                    <div class="form-group" style="position: relative;">
                                        <span class="fa fa-lock form-control-icon"></span>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" placeholder="Password"
                                            style="background-color: #F0F0F0;">
                                        <span style="right: 10px;" class="fa fa-eye form-control-icon-show-password"
                                            onclick="showPassword()"></span>
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
                                    <span style = "color: #4e87b9">Don't Have an Account ?</span>
                                    <a href="/register"
                                        style="color: #4e87b9; text-decoration:underline; cursor: pointer;">Sign Up</a>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <button type="submit" class="btn button-login">
                                        <b
                                            style="letter-spacing:2px; margin: 0 20px 0 20px; font-size: 20px; color: white">
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
    @include('layouts/footer')
</body>

</html>
