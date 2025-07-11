<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $usaha_nama }} | Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/'.$usaha_logo) }}" />

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/Login_v18/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/Login_v18/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/Login_v18/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/Login_v18/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/Login_v18/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/Login_v18/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/Login_v18/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/Login_v18/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/Login_v18/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/Login_v18/css/main.css">
    <!--===============================================================================================-->
</head>

<body style="background-color: #666666;">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="{{ url('login') }}" method="POST">
                    @csrf
                    <span class="login100-form-title">
                        {{ $usaha_nama }}
                    </span>
                    <h5 class="p-b-43 text-center">Login to continue</h5>


                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="username" autofocus>
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Ingat Saya Untuk 7 Hari
                            </label>
                        </div>

                        <!-- <div>
                            <a href="#" class="txt1">
                                Forgot Password?
                            </a>
                        </div> -->
                    </div>


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Login
                        </button>
                    </div>


                </form>

                <div class="login100-more" style="background-image: url({{ asset('images/material-bangunan.jpg') }});">
                </div>
            </div>
        </div>
    </div>





    <!--===============================================================================================-->
    <script src="{{ asset('') }}assets/Login_v18/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('') }}assets/Login_v18/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('') }}assets/Login_v18/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ asset('') }}assets/Login_v18/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('') }}assets/Login_v18/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('') }}assets/Login_v18/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('') }}assets/Login_v18/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('') }}assets/Login_v18/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('') }}assets/Login_v18/js/main.js"></script>

    <!-- sweet Alert -->
    <script src="{{ asset('') }}assets/sweetalert/sweetalert.min.js"></script>

    @if (session('message'))
    <script>
        swal("Informasi", "{{ session('message') }}", "info")
            .then(function() {
                $('#username').focus();
            });
    </script>
    @endif
</body>

</html>