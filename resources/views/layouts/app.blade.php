@php

    $citiess = App\Models\City::orderBy('city_name')->get();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Muft Deal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}">
    <meta name="keywords"
        content="food, abohar,Abohar, muft, muftdeal, restaurant, top , top restaurant, free, new, cafe, abohar cafe">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TDDLSC6L');
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GPXJY9ZRBR"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GPXJY9ZRBR');
    </script>
    <style>
        .form-control:focus {
            box-shadow: none !important;
            border: 1px solid #dee2e6 !important;
        }

        #top-nev {
            position: sticky !important;
            top: 0px !important;
            z-index: 999 !important;
        }

        .shadow-cstm {
            box-shadow: 0 15px 33px #dee2e6 !important;

        }

        .search_bar {
            border: 1px solid black !important;
        }

        .active {
            color: red !important;
        }
    </style>
</head>

<body>
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
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                var errorMessage = @json($errors->first('email') ?? $errors->first('phone'));

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
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TDDLSC6L" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div>
        <section class="header " id="top-nev">
            <div class="container-fluid p-0">
                <nav class="navbar navbar-expand-lg bg-white mb-5">
                    <div class="container">
                        <div class="d-flex">

                            <a class="navbar-brand " href="{{ route('index') }}"><img
                                    src="{{ asset('assets/images/muftdeals.png') }}" class='w-50' alt=""></a>
                            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation" id="navbarToggle">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                        @if (Request::is('/'))
                            {{-- <form id="cityFormMoblie" action="{{ route('city.store') }}" method="post"
                                class="d-block d-md-none w-100 " role="search">
                                @csrf
                                <div class="left-inner-addon input-container px-3" data-bs-toggle="modal" data-bs-target="#review_modal">
                                    <i class="fas fa-search"></i>
                                    <select class="form-select search_bar ps-5 rouded-circle shadow-none  "
                                        name="city" onclick="cityFormMoblie()">
                                        <option disabled selected></option>
                                        @foreach ($citys as $city)
                                            <option value="{{ $city->city_name }}"
                                                @if (session('city_name') == $city->city_name) selected @endif>{{ $city->city_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form> --}}
                            <div class="left-inner-addon input-container px-3 d-block d-md-none  w-100"  data-bs-toggle="modal" data-bs-target="#review_modal" id='city_name'>

                                <div class=" form-control search_bar w-100 px-3 rouded-circle shadow-none" id='select_city_name_sm' onclick="cityFormMoblie()">
                                    {{-- {{session('city_name')?  : 'Select your city'}} --}}

                                </div>
                            </div>
                        @else
                            @if (!empty(session('city_name')))
                                <div class="left-inner-addon input-container px-3 d-block d-md-none  w-100">

                                    <div class=" form-control search_bar w-100 px-3 rouded-circle shadow-none">
                                        {{ session('city_name') }}

                                    </div>
                                </div>
                            @endif
                        @endif
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-bold py-2">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                                        href="{{ route('index') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}"
                                        href="{{ route('about_us') }}">About</a>
                                </li>
                                <li class="nav-item pe-2">
                                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}"
                                        href="{{ route('contact') }}">Contact</a>
                                </li>

                            </ul>

                            @if (Request::is('/'))
                            <div class=" left-inner-addon input-container px-3  d-flex d-none d-md-block">

                                <div class=" form-control search_bar w-100 px-3 rouded-circle shadow-none " id='select_city_name'  data-bs-toggle="modal" data-bs-target="#review_modal" id='city_name'>

                                </div>
                            </div>
                                    {{-- <div class="left-inner-addon input-container px-3"  data-bs-toggle="modal" data-bs-target="#review_modal">
                                        <i class="fas fa-search"></i>
                                        <select class="form-select search_bar ps-5 rouded-circle shadow-none  "
                                            name="city" onchange="submitForm()">
                                            <option disabled selected>{{session('city_name')? session('city_name') : 'Select your city'}}</option>

                                        </select>
                                    </div> --}}
                            @else
                                @if (!empty(session('city_name')))
                                    <div class="left-inner-addon input-container px-3 d-flex d-none d-md-block">

                                        <div class=" form-control search_bar  px-3 rouded-circle shadow-none">
                                            {{ session('city_name') }}

                                        </div>
                                    </div>
                                @endif
                            @endif
                            <a href="{{ route('restaurant-login') }}" class="btn head-btn mt-3 mt-md-0 fw-bold "><i
                                    class="fas fa-mug-hot"></i>
                                Restaurant Login</a>
                        </div>
                    </div>
                </nav>
            </div>
        </section>
        <main>
            @yield('content')
        </main>
        <section class="footer bg-dark text-white pt-5 border-bottom border-danger">
            <div class="container  ">
                <div class="row py-4 text-center">
                    <div class="col-lg-4 col-md-4 mx-auto">
                        <img src="{{ asset('assets/images/muftdeals.png') }}" class='w-50' alt="">
                        <p>Subscribe to our news letter to get latest updates</p>
                        <div>
                            <div class="position-relative mx-5 mx-auto">
                                <input type="text" class="form-control p-2 shadow-none  " name='subscribe'
                                    placeholder="Your email address">
                                <a href="#" class="position-absolute footer-btn btn"
                                    id="subscribebtn">Subscribe</a>
                            </div>
                            <p class="py-3">Follow us on</p>
                        </div>
                        <div class="icons ">
                            <a href="#"><i class="fab fa-facebook p-2 m-2 fs-3 footer-icon"></i></a>
                            <a href="#"><i class="fab fa-twitter p-2 m-2 fs-3 footer-icon"></i></a>
                            {{-- <a href="#"><i class="fab fa-instagram p-2 m-2 fs-3 footer-icon"></i></a> --}}
                            <a href="#"><i class="fab fa-youtube p-2 m-2 fs-3 footer-icon"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 mx-auto pt-5 pt-md-0">
                        <h4>Useful Links</h4>
                        <p><a href="#"
                                class="text-decoration-none text-white text-outline-danger footer-links">Cookies
                                Policy</a></p>
                        <p><a href="{{ route('about_us') }}"
                                class="text-decoration-none text-white text-outline-danger footer-links">About Us</a>
                        </p>
                        <p><a href="{{ route('contact') }}"
                                class="text-decoration-none text-white text-outline-danger footer-links">Contact
                                Us</a></p>
                    </div>
                    <div class="col-lg-4 col-md-4 mx-auto pt-3 pt-md-0">
                         <p class="footer-links"><i class="fab fa-r-project"></i> +91 98880-49484</p>
                        <p class="footer-links"><i class="fas fa-envelope"></i> websystsoftware@gmail.com</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal modal-xl fade" id="review_modal" data-bs-backdrop="static"  tabindex="-1" aria-labelledby="review_modal_label" aria-hidden="true">

            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="search" class='form-control' placeholder="Search for your city">
                    </div>

                        <div class="modal-body">
                            <p class='text-center'>Popular Cities</p>
                            <div class="row">
                                <div class="col">
                                    <img class='city' data-city="Abohar" src="{{ asset('assets/images/ahd.png') }}" alt="">
                                    <p class='text-center city' data-city="Abohar">Abohar</p>
                                </div>
                                <div class="col">
                                    <img class='city' data-city="Amritsar" src="{{ asset('assets/images/bang.png') }}" alt="">
                                    <p class='text-center city' data-city="Amritsar">Amritsar</p>

                                </div>
                                <div class="col">
                                    <img class='city' data-city="Ludhiana" src="{{ asset('assets/images/chd.png') }}" alt="">
                                    <p class='text-center city' data-city="Ludhiana">Ludhiana</p>

                                </div>
                                <div class="col">
                                    <img class='city' data-city="Chennai" src="{{ asset('assets/images/chen.png') }}" alt="">
                                    <p class='text-center city' data-city="Chennai">Chennai</p>

                                </div>
                                <div class="col">
                                    <img class='city' data-city="Hyderabad" src="{{ asset('assets/images/hyd.png') }}" alt="">
                                    <p class='text-center city' data-city="Hyderabad">Hyderabad</p>

                                </div>
                                <div class="col">
                                    <img class='city' data-city="Kochi" src="{{ asset('assets/images/koch.jpeg') }}" alt="">
                                    <p class='text-center city' data-city="Kochi">Kochi</p>

                                </div>
                                <div class="col">
                                    <img class='city' data-city="Kolkata" src="{{ asset('assets/images/kolk.png') }}" alt="">
                                    <p class='text-center city' data-city="Kolkata">Kolkata</p>

                                </div>
                                <div class="col">
                                    <img class='city' data-city="Mumbai" src="{{ asset('assets/images/mumbai.png') }}" alt="">
                                    <p class='text-center city' data-city="Mumbai">Mumbai</p>

                                </div>
                                <div class="col">
                                    <img class='city' data-city="Delhi" src="{{ asset('assets/images/ncr.png') }}" alt="">
                                    <p class='text-center city' data-city="Delhi">Delhi-ncr</p>

                                </div>

                            </div>

                            {{-- <p class='text-center text-danger' id='view_all_city'>View all city</p>
                            <div class="row text-center" id='all_city' style='display:none'>
                                <div class="col-lg-3 city" data-city="Lahore">Lahore</div>
                                <div class="col-lg-3 city" data-city="Faisalabad">Faisalabad</div>
                                <div class="col-lg-3 city" data-city="Rawalpindi">Rawalpindi</div>
                                <div class="col-lg-3 city" data-city="Multan">Multan</div>
                                <div class="col-lg-3 city" data-city="Sialkot">Sialkot</div>
                                <p class='text-center text-danger' id='hide_all_city'>Hide all city</p>
                            </div> --}}
                        </div>

                </div>
            </div>
        </div>

        {{-- <p class="text-center py-3 bg-dark text-white m-0 ">© FoodKing by iNiLabs 2023, All Rights Reserved</p>
     --}}
        <a class="scroll-top-button" href="#"><i class="fas fa-arrow-up p-1"></i></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script>

        function submitForm() {
            $('#review_modal').modal('show');
        }

        function cityFormMoblie() {
            document.getElementById("cityFormMoblie").submit();
        }
        $(document).ready(function() {
            const navbarToggle = $('#navbarToggle');
            const icon = navbarToggle.find('i');
            navbarToggle.on('click', function() {
                if (icon.hasClass('fa-bars')) {
                    icon.removeClass('fa-bars').addClass('fa-times');
                } else {
                    icon.removeClass('fa-times').addClass('fa-bars');
                }
            });
        });
        window.addEventListener("scroll", scrollFunction);

        function scrollFunction() {
            var button = document.querySelector(".scroll-top-button");
            if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
                button.style.display = "block";
            } else {
                button.style.display = "none";
            }
        }
        var navbar = document.getElementById('top-nev');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-cstm');
            } else {
                navbar.classList.remove('shadow-cstm');
            }
        });

        $(document).ready(function() {
            const $citySelect = $('#citySelectmobile');

            $citySelect.change(function() {
                $('#cityFormmobile').submit();
            });
        });
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 2000);


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
