<!DOCTYPE html>

<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="{{ asset('admin/img/fav.png') }}">
    <title> Muft Deal </title>
    <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard-pro" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('admin/cfss/nucleo-icons.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('admin/css/argon-dashboard.min9c7f.css?v=2.0.5') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
    <style>
        .page-item .page-link,
        .page-item span {
            color: black !important;
        }

        .cstm_navbar_design {
            background-color: #5e72e4 !important
        }

        .navbar-vertical .navbar-nav .nav-sm .nav-link,
        .navbar .nav-link,
        .navbar .navbar-brand {
            font-size: 1rem !important;
        }

        .cstm_imagerestaurant {
            height: auto;
            width: 100px !important;
            object-fit: cover;
        }

        .navbar-vertical .navbar-brand-img,
        .navbar-vertical .navbar-brand>img {
            max-width: 100%;
            max-height: 6.6rem;
        }
    </style>

</head>

<body class="g-sidenav-show">
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var errorMessage = @json(session('error'));
                toastMixin.fire({
                    animation: true,
                    title: errorMessage,
                    icon: 'error'
                });
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var successMessage = @json(session('success'));
                toastMixin.fire({
                    animation: true,
                    title: successMessage
                });
            });
        </script>
    @endif
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="text-center mx-auto" href="{{ route('restaurant-home.index') }}">
                <img src="{{ asset('admin/img/muftdeals.png') }}"
                    class="navbar-brand-img   mx-auto text-center w-100 d-grid py-3" alt="Restaurant Image">
            </a>
        </div>
        <hr class="horizontal dark">
        <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('restaurant-home.index') }}">
                        <i class="fas fa-home"></i><span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('restaurant-menu.show', [auth()->guard('restaurant')->user()->id]) }}">
                        <i class="fas fa-shopping-cart"></i><span class="nav-link-text ms-1">Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('restaurant-sliders.index') }}">
                        <i class="fas fa-images"></i> <span class="nav-link-text ms-1"> Slider</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false" href="#vrExamples">
                        <i class="fas fa-cog"></i> <span class="nav-link-text ms-1">Setting</span>
                    </a>
                    <div class="collapse " id="vrExamples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('restaurant-home.edit', [auth()->guard('restaurant')->user()->id]) }}">
                                    <span class="nav-link-text ms-1">Edit Restaurant</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('view') }}">
                                    <span class="nav-link-text ms-1">View Menu</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('restaurant.menu_phone', [auth()->guard('restaurant')->user()->id]) }}">
                                    <span class="nav-link-text ms-1">Menu Number</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('restaurant.background') }}">
                                    <span class="nav-link-text ms-1">Menu Background</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                @if(auth()->guard('restaurant')->user()->billing == 'on')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('billing.index') }}">
                        <i class="fas fa-file-invoice"></i><span class="nav-link-text ms-1">Billing</span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bank-details.index') }}">
                        <i class="fas fa-file-invoice"></i><span class="nav-link-text ms-1">Bank Details</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off"></i> <span class="nav-link-text ms-1"> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </aside>
    <nav class="navbar navbar-main navbar-expand-lg  p-0 px-3  shadow-none    z-index-sticky cstm_navbar_design">
        <div class="container-fluid py-3 px-3">
            <div class="sidenav-toggler sidenav-toggler-inner d-xl-block mx-auto text-center  d-none"
                style="margin-left: 280px !important;">
                <a href="javascript:;" class="nav-link p-0 ">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-light"></i>
                        <i class="sidenav-toggler-line bg-light"></i>
                        <i class="sidenav-toggler-line bg-light"></i>
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                </div>
                <ul class="navbar-nav  justify-content-between">
                    <li class='nav-item'>
                        <button type='button' class=" mx-2 btn btn-white" data-bs-toggle="modal"
                        data-bs-target="#myModal">Change Password</button>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link text-white font-weight-bold px-0" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="fas fa-power-off"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="modal fade"id="myModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalSignTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Change Password</h4>
                    <a href="#" class="ms-auto" data-bs-dismiss="modal"><i class="fas fa-times fs-4"></i></a>
                </div>
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        {{-- <div class="card-header text-center">
                            <h4>Change Password</h4>
                        </div> --}}


                        <div class="card-body pb-3">

                            <form role="form text-left" action="{{ route('restaurant.change_password') }}" method="POST">
                                @csrf


                                <label>Old Password</label>
                                <div class="input-group mb-3">
                                    <input type="text" name='old_pass' class="form-control" placeholder="Enter Old Password" required>
                                </div>
                                <label>New Password</label>
                                <div class="input-group mb-3">
                                    <input type="text" name='new_pass' class="form-control"  placeholder="Enter New Password" required>
                                </div>
                                <label>Confirm Password</label>
                                <div class="input-group mb-3">
                                    <input type="text" name='confirm_pass' class="form-control"  placeholder="Confirm Password" required >
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <main>
        @yield('content')
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

    <script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('admin/js/argon-dashboard.min9c7f.js?v=2.0.5') }}"></script>
    {{-- <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v2cb3a2ab87c5498db5ce7e6608cf55231689030342039"
        integrity="sha512-DI3rPuZDcpH/mSGyN22erN5QFnhl760f50/te7FTIYxodEF8jJnSFnfnmG/c+osmIQemvUrnBtxnMpNdzvx1/g=="
        data-cf-beacon='{"rayId":"7e69ebdb090c2bae","version":"2023.4.0","r":1,"b":1,"token":"1b7cbb72744b40c580f8633c6b62637e","si":100}'
        crossorigin="anonymous"></script> --}}

    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v2cb3a2ab87c5498db5ce7e6608cf55231689030342039"></script>
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/owl.carousel.min.js') }}"></script>
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
