<!DOCTYPE html>
<html>
    <head>
        <title>Profile || Cafe Reservation</title>
    </head>
    @include('layouts/navbar')
    <body>
        <div class="container-profile">
            <h2><b>Edit Profile</b></h2>
            <div class="register-body">
                <form method="POST" action="{{ route('edit-profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="image-container">
                                @if($user->profile_picture == null)
                                <img src="images/upload.png" alt="default upload" id="default_image" width="80px" height="70px" style=" display:block; margin: 0 auto 0 auto; padding:5px;">
                                @else
                                <img src="storage/{{$user->profile_picture}}" alt="Uploaded Profile Picture" id="uploaded_image" width="80px" height="70px" style=" display:block; margin: 0 auto 0 auto; padding:5px;">
                                @endif
                                <img src="#" id="uploaded_image" width="80px" height="70px" style=" display:block; margin: 0 auto 0 auto; padding:5px;" hidden/>
                            </div>
                            <input id="profile_picture" type="file" accept="image/*"
                                onChange = "document.getElementById('uploaded_image').src = window.URL.createObjectURL(this.files[0]); document.getElementById('uploaded_image').removeAttribute('hidden');
                                document.getElementById('default_image').setAttribute('hidden', true);" 
                                class="form-control" name="profile_picture" autofocus>                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-2 mx-auto">
                            <label for="name" class="row-md-4 row-form-label text-md-end p-1">{{ __('Name') }}</label>

                            <div class="row-md-3">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus style="border-radius:30px; background-color: #F0F0F0;">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2 mx-auto">
                            <label for="email" class="row-md-4 row-form-label text-md-end p-1">{{ __('Email Address') }}</label>

                            <div class="row-md-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" style="border-radius:30px; background-color: #F0F0F0;">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col mb-2 mx-auto">
                            <label for="username" class="row-md-4 row-form-label text-md-end p-1">{{ __('Username') }}</label>

                            <div class="row-md-3">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->email }}" required autocomplete="username" autofocus style="border-radius:30px; background-color: #F0F0F0;">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2 mx-auto">
                            <label for="password" class="row-md-4 row-form-label text-md-end p-1">{{ __('Password') }}</label>

                            <div class="row-md-3 mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" style="border-radius:30px; background-color: #F0F0F0;">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col mb-2 mx-auto">
                            <label for="address" class="row-md-4 row-form-label text-md-end p-1">{{ __('Address') }}</label>

                            <div class="row-md-3">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user->address }}" autocomplete="address" autofocus style="border-radius:30px; background-color: #F0F0F0;">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2 mx-auto">
                            <label for="phone_number" class="row-md-4 row-form-label text-md-end p-1">{{ __('Phone Number') }}</label>

                            <div class="row-md-3">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $user->phone_number }}" autocomplete="phone_number" autofocus style="border-radius:30px; background-color: #F0F0F0;">

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row pt-5">
                        <div class="col-md-8 offset-md-7 text-center">
                            <button type="submit" class="btn button-login">
                                <b style="letter-spacing:2px; margin: 0 20px 0 20px; font-size: 20px;">
                                    Save
                                </b>
                            </button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        @include('layouts/footer')
    </body>
</html>

