<!DOCTYPE html>
<html>

<head>
    <title>Login || Sekolah</title>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
</head>
@auth
    @if (Auth::user()->role == 'ADMIN')
        @include('layouts/admin_navbar')
    @elseif (Auth::user()->role == 'GURU')
        @include('layouts/guru_navbar')
    @elseif (Auth::user()->role == 'SISWA')
        @include('layouts/siswa_navbar')
    @endif
@else
    @include('layouts/siswa_navbar')
@endauth

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
                                        <input id="username" type="username"
                                            class="form-control @error('username') is-invalid @enderror "
                                            name="username" value="{{ old('username') }}" placeholder="Username"
                                            required autocomplete="username" autofocus
                                            style="background-color: #F0F0F0;">
                                    </div>
                                    @error('username')
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
</body>

</html>
