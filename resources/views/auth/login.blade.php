<!doctype html>
<html lang="zxx">


<!-- Mirrored from bnker.netlify.app/ltr/login by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Apr 2025 04:31:16 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Organiz | Sign into sweet experiences </title>
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

    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">


    <!-- /All CSS -->

</head>

<body>

    @if (session('success'))
        <div id="successMessage" class="alert alert-success text-center p-3"
            style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
               background-color: rgb(255, 70, 75); color: white; width: 40%; 
               border-radius: 8px; z-index: 1000;">
            <p>{{ session('success') }}</p>
        </div>

        <script>
            setTimeout(() => {
                document.getElementById('successMessage').style.display = 'none';
            }, 4000);
        </script>
    @endif




    <!-- Login -->
    <div class="login-page d-flex align-items-center vh-100">
        <div class="overlay"></div>
        <div class="login-form">
            <!-- Container -->
            <div class="container">

                <form method="POST" action="{{ route('login') }}">
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
                        <input id="email" type="email" id="inputUsername" required placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <span class="login-form-icon"><i class="uil uil-lock"></i></span>
                        <input id="password" type="password" placeholder="Password" required
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            autocomplete="new-password">


                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                            <label class="form-check-label form-check-box" for="rememberMe">Keep me logged in</label>
                        </div>
                    </div>


                    <div class="row justify-content-center mb-md-3">
                        <div class="col-sm-6 mb-md-3 mb-sm-0">
                            <button type="submit" class="btn theme-btn-1">Log In</button>
                        </div>

                        <div class="col-sm-6 text-sm-end">
                            <a href="{{ route('password.request') }}">Forgot Password?</a>

                        </div>
                    </div>

                    <div class="login-footer">Don't have an account? <a href='{{ route('register') }}'>Signup</a>
                    </div>
                </form>
            </div>
            <!-- Container -->
        </div>
    </div>
    <!-- /login -->

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


    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                // 🎉 Trigger confetti when page loads
                var duration = 3 * 1000; // 3 seconds
                var end = Date.now() + duration;
                (function frame() {
                    confetti({
                        particleCount: 3,
                        spread: 100,
                        startVelocity: 30,
                        origin: {
                            y: 0.6
                        }
                    });
                    if (Date.now() < end) {
                        requestAnimationFrame(frame);
                    }
                })();
            @endif
        });
    </script>


</body>


<!-- Mirrored from bnker.netlify.app/ltr/login by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Apr 2025 04:31:16 GMT -->

</html>
