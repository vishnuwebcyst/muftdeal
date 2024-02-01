@extends('layouts.app')
@section('content')
    <style>
        .section-title {
            margin-bottom: 2px !important;
            font-weight: 700;
            line-height: 1.2;
            color: #EE2540;

        }

        .af::after {
            content: " ";
            background: #EE2540;
            height: 1px;
            display: block;
            margin: -16px 0 0 0;
        }

        h3.sec2 span {
            background-color: white;
            padding: 19px;
        }
    </style>
    <main class="main-content position-relative border-radius-lg ">
        <section class="header">
            <div class="container">
                <div class="owl-carousel owl-theme">
                    @foreach ($sliders as $slider)
                        <div class="item " style='max-height: 400px'><img src="{{ asset($slider->image) }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="container py-4">
            <div class="">
                <div class="row  p-lg-5 p-3">
                    <div class="d-flex justify-content-between py-3">
                        {{-- <h4 class="text-color">About Us</h4> --}}
                    </div>
                    <div class="col-lg-12 mx-auto text-center">

                        <h3 class="section-title text-center sec2 af pb-5"><span>About Us</span> </h3>
                        <p>Welcome to MuftDeal, the ultimate destination for restaurant enthusiasts and foodies alike!
                            We take pride in being your go-to platform for discovering the finest dining establishments and
                            placing seamless orders from the comfort of your home. MuftDeal is not just a website; it's your
                            culinary companion, dedicated to enhancing your dining experience. Our platform brings together
                            a curated selection of top-notch restaurants, ensuring you have access to a diverse range of
                            delectable cuisines. Whether you're a food explorer or someone seeking the comforts of your
                            favorite local spot, MuftDeal is here to connect you with exceptional eateries and facilitate
                            hassle-free online ordering. Join us in celebrating the joy of good food, and let MuftDeal be
                            your guide to savoring every bite, one order at a time.</p>

                        <h3 class="section-title text-center sec2 af pb-5"><span>Our Vision</span> </h3>
                        <p>At MuftDeal, our vision is to celebrate the rich culinary diversity of each city by offering a
                            dedicated platform for discovering and savoring local restaurant experiences. We are committed
                            to connecting food enthusiasts with a plethora of dining options, creating a delightful journey
                            through the vibrant flavors of every community.</p>

                        <h3 class="section-title text-center sec2 af pb-5"><span>Our Mission</span> </h3>
                        <p>At MuftDeal, our mission is to enhance the dining experience by providing a comprehensive
                            platform exclusively for local restaurants. We aim to simplify and enrich the lives of food
                            lovers by offering a curated selection of eateries, fostering a thriving community, and
                            promoting the diverse culinary landscape in every city we serve.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/owl.carousel.min.js') }}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            autoplay: true,
            autoplayTimeout: 3000,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    </script>
@endsection
