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
                <form class="login100-form validate-form" id="form" method="POST">
                    @csrf
                    <span class="login100-form-title">
                        {{ $usaha_nama }}
                    </span>
                    <h5 class="p-b-43 text-center">Login to continue</h5>

                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="text" name="username" id="username" autofocus>
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" id="password">
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
    <script src="{{ asset('') }}assets/Login_v18/vendor/animsition/js/animsition.min.js"></script>
    <script src="{{ asset('') }}assets/Login_v18/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ asset('') }}assets/Login_v18/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('') }}assets/Login_v18/vendor/select2/select2.min.js"></script>
    <script src="{{ asset('') }}assets/Login_v18/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('') }}assets/Login_v18/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="{{ asset('') }}assets/Login_v18/vendor/countdowntime/countdowntime.js"></script>
    <script src="{{ asset('') }}assets/Login_v18/js/main.js"></script>
    <script src="{{ asset('') }}assets/sweetalert/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#form').on('submit', function (e) {
                e.preventDefault(); // Cegah reload halaman

                // Tampilkan loading atau disable button
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled', true);

                $.ajax({
                    url: "{{ url('login') }}",
                    method: "POST",
                    data: $(this).serialize(), // Ambil semua data form
                    dataType: "json",
                    success: function (response) {

                        if (response.success) {
                            submitBtn.html('<i class="fa fa-spinner fa-spin"></i> Loading menu pengguna...');

                            $.ajax({
                                url: "{{ url('login/loadMenus') }}",
                                type: 'GET',
                                dataType: 'json',
                            })
                            .done(function(response) {
                                console.log(response);
                                window.location.href = "{{ url('/') }}";

                                // swal({
                                //     icon: 'success',
                                //     title: 'Berhasil!',
                                //     text: "Login berhasil, redirecting...",
                                //     timer: 2000,
                                //     showConfirmButton: false
                                // }).then(() => {
                                //     window.location.href = "{{ url('/') }}";
                                // });
                            })
                            .fail(function() {
                                console.log('error loadMenus');
                            });

                            

                        } else {
                            submitBtn.html(originalText).prop('disabled', false);

                            swal("Gagal!", response.message || "Username atau password salah.", "error")
                                .then(() => {
                                    $('#username').focus();
                                });
                        }
                    },
                    error: function (xhr) {
                        submitBtn.html(originalText).prop('disabled', false);
                        let message = "Terjadi kesalahan.";

                        if (xhr.status === 422) {
                            // Validasi error
                            const errors = xhr.responseJSON.errors;
                            message = Object.values(errors).flat().join("<br>");
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        swal("Error!", message, "error")
                            .then(() => {
                                $('#username').focus();
                            });
                    }
                });
            });
        });
    </script>

    @if (session('message'))
        <script>
            swal("Informasi", "{{ session('message') }}", "info")
                .then(() => {
                    $('#username').focus();
                });
        </script>
    @endif

</body>

</html>