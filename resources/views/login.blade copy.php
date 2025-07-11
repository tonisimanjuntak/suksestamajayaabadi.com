<!doctype html>
<html lang="en">

<head>
    <title>Login | CV. CAHAYA LAMBOY KOTA PONTIANAK</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}images/logo.png" />

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('') }}assets/login-form-11/css/style.css">

    <style>
        body {
            background-image: url("{{ asset('') }}images/bglogin.jpg");
            background-size: 100vw 100vh;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ asset('') }}images/logo.png" alt="" style="width: 80px;">
                        </div>
                        <h5 class="text-center mb-4">CV. CAHAYA LAMBOY KOTA PONTIANAK</h5>
                        <form action="{{ url('login') }}" class="login-form" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control rounded-left" placeholder="Username"
                                    name="username" id="username" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" class="form-control rounded-left" placeholder="Password"
                                    name="password" id="password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                    class="form-control btn btn-primary rounded submit px-3">Login</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('') }}assets/login-form-11/js/jquery.min.js"></script>
    <script src="{{ asset('') }}assets/login-form-11/js/popper.js"></script>
    <script src="{{ asset('') }}assets/login-form-11/js/bootstrap.min.js"></script>
    <script src="{{ asset('') }}assets/login-form-11/js/main.js"></script>
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
