<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Muft Deal</title>
    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- bootstrap 4 link  -->
    <style>
        body {
            /* background-color: #fff; */
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            height: 100vh !important;
            /* background-image: url({{ asset('admin/img/restaurant-login.svg') }}); */
            background-image: url({{ asset('admin/img/liquid-cheese.svg') }});
        }

        .card {
            backdrop-filter: blur(8px);
            background-color: #ffffff33;
            left: 50%;
            transform: translate(-50%, 50%);
        }

        .form-control {
            background-color: white !important;
            border: 1px solid black !important;
            box-shadow: none !important;
        }

        .password-container {
            position: relative;
        }

        input[type="password"] {
            padding-right: 30px;
        }

        .toggle-password {
            position: absolute;
            top: 75%;
            right: 20px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        #eye-icon {
            font-size: 18px;
            color: #333;
        }

        .text-color {
            /* background-color: #FF0032 !important; */
            background-color: #5e72e4 !important;
            color: white !important;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12 animate__animated animate__slideInDown">
                <div class="card py-2 shadow-lg border-0 ">

                    <div class="mx-auto text-center">
                        <img src="{{ asset('admin/img/muftdeals.png') }}" class="w-75" alt="">
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('restaurant-check') }}">
                            @csrf
                            <input type="hidden" name="id">
                            <div class="row mb-3">
                                <div class="col-md-10 mx-auto">
                                    <label for="phone" class="col-form-label fw-bold text-md-end">Phone
                                        Number</label>
                                    <input id="phone" type="text" placeholder="Enter Phone Number"
                                        class="form-control @if (session('error')) is-invalid @endif"
                                        name="phone">


                                    @if (session('error'))
                                        <p class="text-danger">{{ session('error') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-10 mx-auto password-container">
                                    <label for="password" class="col-form-label fw-bold text-md-end">Password</label>
                                    <input id="password" type="password" id="password" class="form-control "
                                        name="password" placeholder="Enter Password" @if (session('error')) is-invalid @endif>
                                    <span id="toggle-password" class="toggle-password">
                                        <i class="fas fa-eye text-dark" id="eye-icon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-12 text-center mx-auto">
                                    <button type="submit" class="btn text-color w-50 rounded-pill">Login</button>
                                </div>
                                <a href="{{ route('restaurant-register') }}"
                                    class="py-2 h5 text-center text-dark text-decoration-none">Don’t have an account?
                                    Signup</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            const passwordField = $('#password');
            const eyeIcon = $('#eye-icon');
            eyeIcon.click(function() {
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    eyeIcon.addClass('fa-eye-slash').removeClass('fa-eye');
                } else {
                    passwordField.attr('type', 'password');
                    eyeIcon.addClass('fa-eye').removeClass('fa-eye-slash');
                }
            });
        });
    </script>
    <script>
        var toastMixin = Swal.mixin({
            toast: true,
            icon: 'success',
            title: 'General Title',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
</body>

</html>
