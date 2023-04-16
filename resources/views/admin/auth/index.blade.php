<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Vizyonix - Admin Dashboard</title>
    <meta name="description" content="Vizyonix - Admin Dashboard">
    <meta name="author" content="roosecs">
    <meta name="robots" content="noindex, nofollow">
    <meta property="og:title" content="Vizyonix - Admin Dashboard">
    <meta property="og:site_name" content="Vizyonix">
    <meta property="og:description" content="Vizyonix - Admin Dashboard">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" href="{{asset('media/favicons/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('media/favicons/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('media/favicons/apple-touch-icon-180x180.png')}}">
    @vite(['resources/sass/main.scss'])
    <link rel="stylesheet" href="{{asset('js/plugins/sweetalert2/sweetalert2.min.css')}}">

</head>
<body>
<div id="page-container">
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('media/photos/photo19@2x.jpg');">
            <div class="row g-0 justify-content-center bg-primary-dark-op">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <!-- Sign In Block -->
                    <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                        <div
                            class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
                            <!-- Header -->
                            <div class="mb-2 text-center">
                                <a class="link-fx fw-bold fs-1" href="index.html">
                                    <span class="text-dark">Vizyon</span><span class="text-primary">ix</span>
                                </a>
                                <p class="text-uppercase fw-bold fs-sm text-muted">GİRİŞ YAP</p>
                            </div>
                            <!-- END Header -->
                            <form class="js-validation-signin" id="loginForm" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <div class="input-group input-group-lg">
                                        <input type="text" class="form-control" id="email"
                                               name="email" placeholder="Username">
                                        <span class="input-group-text">
                          <i class="fa fa-user-circle"></i>
                        </span>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="input-group input-group-lg">
                                        <input type="password" class="form-control" id="password"
                                               name="password" placeholder="Password">
                                        <span class="input-group-text">
                          <i class="fa fa-asterisk"></i>
                        </span>
                                    </div>
                                </div>
                                <div
                                    class="d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-start mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember_me"
                                               name="remember_me" checked>
                                        <label class="form-check-label" for="remember_me">Beni Hatırla</label>
                                    </div>
                                    <div class="fw-semibold fs-sm py-1">
                                        <a href="javascript:forgotPassword()">Şifreni mi unuttun?</a>
                                    </div>
                                </div>
                                <div class="text-center mb-4">
                                    <button type="submit" class="btn btn-hero btn-primary">
                                        <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Sign In
                                    </button>
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>
                    </div>
                    <!-- END Sign In Block -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->

<!--
  Dashmix JS

  Core libraries and functionality
  webpack is putting everything together at assets/_js/main/app.js
-->
<script src="{{asset('js/dashmix.app.min.js')}}"></script>

<!-- jQuery (required for jQuery Validation plugin) -->
<script src="{{asset('js/lib/jquery.min.js')}}"></script>

<!-- Page JS Plugins -->
<script src="{{asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

<!-- Page JS Code -->
<script src="{{asset('js/pages/validations/login.js')}}"></script>
<script src="{{asset('js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script>
    function forgotPassword() {
        alert('İnş bulursun knk')
    }

    $(document).ready(function () {
        $('#loginForm').submit(function (e) {
            e.preventDefault();
            if ($(this).valid()) {
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{route('admin_login')}}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        location.href="{{route('admin_dashboard')}}";
                        return;
                    },
                    error: function (data) {
                        Swal.fire(
                            'Hata!',
                            data.responseJSON.message,
                            'error'
                        )
                        return;
                    }
                });
            }

        })
    });
</script>
</body>
</html>
