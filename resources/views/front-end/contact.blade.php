@extends('layouts.app')
@section('content')

<main class="main-content position-relative border-radius-lg ">
    <section class="header">
        <div class="container">
            <div class="owl-carousel owl-theme">
                @foreach ($sliders as $slider)
                    <div class="item " style='max-height: 400px'><img src="{{ asset($slider->image) }}" alt=""></div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="container py-4  ">
        <div class="">
            <div class="row  p-lg-5 p-3">
                <div class="d-flex justify-content-between py-3">
                    <h4 class="text-color">Contact Us</h4>
                </div>
                <div class="col-lg-4 text-center mt-3">
                    <div class="card pb-4">
                        <div class="icon mx-auto text-center py-4">
                            <img src="{{asset('assets/images/email.png')}}" alt="" class="w-50 mx-auto ">
                        </div>
                        <div class="text">
                            <h4>Email Address</h4>
                            <p>websystsoftware@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center mt-3">
                    <div class="card pb-4">
                        <div class="icon mx-auto text-center py-4">
                            <img src="{{asset('assets/images/telephone.png')}}" alt="" class="w-50 mx-auto ">
                        </div>
                        <div class="text">
                            <h4>Phone Number</h4>
                            <p>(+91) 99509 89567</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center mt-3">
                    <div class="card  ">
                        <div class="icon mx-auto text-center py-3">
                            <img src="{{asset('assets/images/placeholder.png')}}" alt="" class="w-50 mx-auto ">
                        </div>
                        <div class="text">
                            <h4>Address</h4>
                            <p>St. No. 10, Chotti Pouri,<br>
                                Nai Abadi, Abohar,<br>
                                Dist. Fazilka, Punjab, 152116</p>

                            {{-- <p>(+91) 98880 49484</p> --}}
                        </div>
                    </div>
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
