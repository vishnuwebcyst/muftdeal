@extends('layouts.app')

@section('content')
    <style>
        .owl-theme .owl-dots .owl-dot span {
            width: 20px;
            height: 4px;
        }

        .restaurant-type {
            display: flex;
            align-items: center;
        }

        .restaurant_type {
            height: 10px;
            width: 10px;
            border-radius: 50%;
        }


        .inner-img {

            object-fit: contain;
            aspect-ratio: 1/1 !important;
            transition: .5s;
            width: 100%;
        }

        .inner-img:hover {
            transform: scale(1.2);
        }
    </style>
    <section class="header">
        <div class="container">
            <div class="owl-carousel owl-theme">
                @foreach ($sliders as $slider)
                    <div class="item " style='max-height: 400px'><img src="{{ asset($slider->image) }}" alt=""></div>
                @endforeach
            </div>
        </div>
    </section>
    <button class=' btn head-btn fw-bold' data-bs-toggle="modal" data-bs-target="#review_modal">
        <i class="fas fa-star"></i> button </button>
    <button id="reloadButton" class='btn head-btn fw-bold' data-bs-toggle="modal" data-bs-target="#review_modal">
        <i class="fas fa-star"></i> button
    </button>
    <section class="all-restaurant">
        <div class="container py-3">
            <div class="row">
                @if (count($restaurants) > 0)
                    <div class="d-flex justify-content-between py-3">
                        <h4 class="text-color">All Restaurants</h4>
                    </div>
                    @foreach ($restaurants as $restaurant)
                        <div class="col-lg-3 col-sm-6 pt-5">
                            <a href="{{ route('fooditem.show', [base64_encode($restaurant->id)]) }}"
                                class='text-decoration-none text-dark'>

                                <div class="card mx-2 rounded-4 overflow-hidden border-0 shadow restaurant-card ">
                                    <div class="img-wrapper">
                                        {{-- <img class="inner-img " src="{{ asset('uploads/images/' . $restaurant->image) }}" /> --}}
                                        <img class="inner-img "
                                            src="{{ asset('uploads/images/' . $restaurant->thumbnail) }}" />
                                    </div>
                                    <div class="card-body">
                                        <h4 class="  text-truncate">{{ $restaurant->restaurant_name }}</h4>
                                        <p class="text-truncate"> {{ $restaurant->location }}</p>

                                        <div class="d-flex">
                                            <h4 class="restaurant_type  mt-2 d-flex align-items-center justify-content-center"
                                                style="background-color: {{ $restaurant->restaurant_type === 'veg' ? 'green' : 'red' }};">
                                            </h4>
                                            <span class="ms-2">{{ $restaurant->restaurant_type }}</span>
                                        </div>
                                        {{-- @if ($restaurant->rating > 0)
                                           <p> {{ $restaurant->rating }} of 5 star rating </p>
                                        @else
                                            <p>no rating yet</p>
                                        @endif

                                        @php
                                            $rating = $restaurant->rating;

                                            if (!is_numeric($rating)) {
                                                $rating = 0;
                                            }

                                            $filledStars = floor($rating);
                                            $halfStar = $rating - $filledStars >= 0.5;
                                        @endphp

                                        <div class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $filledStars)
                                                    <i class="fas fa-star" style="color: red;"></i>
                                                @elseif ($halfStar && $i == $filledStars + 1)
                                                    <i class="fas fa-star-half-alt" style="color: red;"></i>
                                                @else
                                                    <i class="far fa-star" style="color:red"></i>
                                                @endif
                                            @endfor
                                        </div> --}}


                                    </div>

                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <h4 class="text-color">Restaurant Not Found </h4>
                @endif
            </div>
        </div>
    </section>
    <section class='py-5'>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <img src="{{ asset('assets/images/pic10.png') }}" class="w-100" alt="">
                </div>
                <div class="col-lg-6 col-md-6 pt-3 pt-md-0">
                    <img src="{{ asset('assets/images/pic11.png') }}" class="w-100" alt="">
                </div>
            </div>
        </div>
    </section>

    <div class="modal modal-xl fade" id="review_modal" tabindex="-1" aria-labelledby="review_modal_label"
        aria-hidden="true">

        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="search" class='form-control' placeholder="Search for your city">
                </div>
                <form action="{{ route('rating.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p class='text-center'>Popular Cities</p>
                        <div class="row">
                            <div class="col">
                                <img src="{{ asset('assets/images/ahd.png') }}" alt="">
                                <p class='text-center'>Ahmedabad</p>
                            </div>
                            <div class="col">
                                <img src="{{ asset('assets/images/bang.png') }}" alt="">
                                <p class='text-center'>Bengaluru</p>

                            </div>
                            <div class="col">
                                <img src="{{ asset('assets/images/chd.png') }}" alt="">
                                <p class='text-center'>Chandigarh</p>

                            </div>
                            <div class="col">
                                <img src="{{ asset('assets/images/chen.png') }}" alt="">
                                <p class='text-center'>Chennai</p>

                            </div>
                            <div class="col">
                                <img src="{{ asset('assets/images/hyd.png') }}" alt="">
                                <p class='text-center'>Hyderabad</p>

                            </div>
                            <div class="col">
                                <img src="{{ asset('assets/images/koch.jpeg') }}" alt="">
                                <p class='text-center'>Kochi</p>

                            </div>
                            <div class="col">
                                <img src="{{ asset('assets/images/kolk.png') }}" alt="">
                                <p class='text-center'>Kolkata</p>

                            </div>
                            <div class="col">
                                <img src="{{ asset('assets/images/mumbai.png') }}" alt="">
                                <p class='text-center'>Mumbai</p>

                            </div>
                            <div class="col">
                                <img src="{{ asset('assets/images/ncr.png') }}" alt="">
                                <p class='text-center'>Delhi-ncr</p>

                            </div>
                            <div class="col">
                                <img src="{{ asset('assets/images/pune-selected.png') }}" alt="">
                                <p class='text-center'>Pune</p>

                            </div>
                        </div>

                        <p class='text-center text-danger' id='view_all_city'>View all city</p>
                        <div class="row text-center" id='all_city' style='display:none'>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <div class="col-lg-3">test</div>
                            <p class='text-center text-danger' id='hide_all_city'>Hide all city</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/owl.carousel.min.js') }}"></script>
    <script>
        $("#view_all_city").click(function() {
            $("#all_city").show();
        });
        $("#hide_all_city").click(function() {
            $("#all_city").hide();
        });
        $(document).ready(function() {


            // Check if the modal should be opened
            var shouldOpenModal = /* Add your condition for opening the modal here */ true;

            if (shouldOpenModal) {
                // Trigger the modal opening
                $('#review_modal').modal('show');
            }
        });
    </script>
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
