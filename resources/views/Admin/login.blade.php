<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../../assets/img/apple-icon.png">
     <title> Muft Deal </title>
    <link rel="icon" type="image/png" href="{{ asset('admin/img/fav.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="{{ asset('admin/js/42d5adcbca.js') }}" crossorigin="anonymous"></script>
    <link href="{{ asset('admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('admin/css/argon-dashboard.min9c7f.css?v=2.0.5') }}" rel="stylesheet" />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <style>
        .cstm_style {
            position: fixed;
            bottom: 0px;
            right: 10px;
            z-index: 9999;
        }
        .card {
            background-color: #ffffff33 !important;
            backdrop-filter: blur(8px) !important;
         }

        body {
            /* background-image: url({{asset('admin/img/admin-bg.svg')}}) !important; */
             background-image: url({{asset('admin/img/liquid-cheese.svg')}}) !important;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .password-container {
            position: relative;
        }

        .password-container {
            position: relative;
        }

        input[type="password"] {
            padding-right: 30px;
        }

        .toggle-password {
            position: absolute;
            top: 78%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        #eye-icon {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>

<body>
    <main class="main-content">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class=" col-lg-6 col-md-7 mx-auto">
                            <div class="card  p-lg-3 animate__animated  animate__slideInDown">
                                <div class=" py-2 mx-auto text-center">
                                    <img src="{{ asset('admin/img/muftdeals.png') }}" class="w-75" alt="">
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.login.check') }}">
                                        @csrf
                                        <div class="mb-3">
                                             <label for="email" class="col-form-label text-md-end">Email</label>

                                            <input id="email" type="email"
                                                class="form-control @if ($errors->has('email')) is-invalid @endif"
                                                name="email" placeholder="Enter Email">
                                            @if ($errors->has('email'))
                                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            {{-- <label for="password">Enter Password</label>
                                            <input id="password" type="password" class="form-control " name="password"
                                                placeholder="Enter Password"@error('password') is-invalid @enderror"> --}}
                                                <div class=" mx-auto password-container">
                                                    <label for="password" class="col-form-label text-md-end">Password</label>
                                                    <input id="password" type="password"  id="password" class="form-control " name="password"
                                                        placeholder="Enter Password">
                                                        <span id="toggle-password" class="toggle-password">
                                                            <i class="fas fa-eye text-dark" id="eye-icon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="text-center py-3">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary btn-lg  rounded-pill mt-4 mb-0">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
</body>
</html>
