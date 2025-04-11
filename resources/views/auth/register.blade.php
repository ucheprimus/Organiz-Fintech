<!doctype html>
<html lang="zxx">


<!-- Mirrored from bnker.netlify.app/ltr/signup by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Apr 2025 04:31:16 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Organiz | Register with Us, and enjoy the dividends </title>
    <!-- /Required meta tags -->

    <!-- Favicon -->
    <link rel="shortcut icon" href="/user/images/favicon.png" type="image/x-icon">
    <!-- /Favicon -->

    <!-- All CSS -->

    <!-- Vendor Css -->
    <link rel="stylesheet" href="/user/css/vendors.css">
    <!-- /Vendor Css -->

    <!-- Plugin Css -->
    <link rel="stylesheet" href="/user/css/plugins.css">
    <!-- Plugin Css -->

    <!-- Icons Css -->
    <link rel="stylesheet" href="/user/css/icons.css">
    <!-- /Icons Css -->

    <!-- Style Css -->
    <link rel="stylesheet" href="/user/css/style.css">
    <!-- /Style Css -->

    <!-- /All CSS -->

    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">


</head>

<body>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <!-- Login -->
    <div class="login-page d-flex align-items-center vh-100">
        <div class="overlay"></div>
        <div class="login-form">
            <!-- Container -->
            <div class="container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="login-social-icon">
                        <h2>Signup</h2>
                        <ul class="social-buttons">
                            <li class="social-buttons-hover">
                                <a href="http://google.com/">
                                    <i class="ri-google-fill"></i>
                                </a>
                            </li>
                            <li class="social-buttons-hover">
                                <a href="https://twitter.com/">
                                    <i class="uil uil-twitter"></i>
                                </a>
                            </li>
                            <li class="social-buttons-hover">
                                <a href="https://www.facebook.com/">
                                    <i class="uil uil-facebook-f"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="input-group">
                        <span class="login-form-icon"><i class="uil uil-user"></i></span>

                        <input id="inputUsername" placeholder="Username" type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <span class="login-form-icon"><i class="uil uil-envelope"></i></span>
                        <input type="email" id="inputEmail" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="login-form-icon"><i class="uil uil-lock"></i></span>
                                <input id="password" type="password" placeholder="Password"
                                    required class="form-control  @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">
                    
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="login-form-icon"><i class="uil uil-lock"></i></span>
                                <input id="password-confirm" placeholder="Confirm Password" type="password"
                                    class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label form-check-box" for="rememberMe">I agree to the <a
                                    class="" href="#">Terms & Conditions</a></label>
                        </div>
                    </div>

                    <div class="row justify-content-center mb-md-3">
                        <div class="col-sm-6 mb-md-3 mb-sm-0">
                            <button type="submit" class="btn theme-btn-1">Sign Up</button>
                        </div>
                    </div>

                    <div class="login-footer">Already have an account? <a href='{{ route('login') }}'>Login</a></div>
                </form>
            </div>
            <!-- /Container -->
        </div>
    </div>
    <!-- /Login -->

    <!-- JS -->

    <!-- Vendor Js -->
    <script src="/user/js/vendors.js"></script>
    <!-- /Vendor js -->

    <!-- Plugins Js -->
    <script src="/user/js/plugins.js"></script>
    <!-- /Plugins Js -->

    <!-- Main JS -->
    <script src="/user/js/main.js"></script>
    <!-- /Main JS -->

    <!-- /JS -->

</body>

</html>


{{-- 
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="password-confirm"
            class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
        </div>
    </div>

    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </div>
</form> --}}
