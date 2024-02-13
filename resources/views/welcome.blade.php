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

        .search_btn {
            background-color: #FF0032;
            color: white !important;
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

        .search {
            position: relative;
            width: 100%;
            display: block;
        }



        .search input {
            text-indent: 32px;
        }

        .search .fa-search {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .search .fa-search {
            left: 10px;
            right: auto;
        }

        .city_latter {
            border: 1px solid black;
            padding: 5px;
            border-radius: 10px;
            font-weight: bolder;
            margin-left: 10px;
            margin-right: 10px;
            cursor: pointer;

        }

        /* .city_image {
                    width: 60px;
                    aspect-ratio: 1/1;
                } */
        .cities {
            cursor: pointer;
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
    {{-- <button class=' btn head-btn fw-bold' data-bs-toggle="modal" data-bs-target="#review_modal">
        <i class="fas fa-star"></i> button </button> --}}

    <section class="all-restaurant">
        <div class="container py-3">

            <form action="" method="get" class='col-sm-12 col-lg-3 py-3 mx-auto text-center'>
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Search restaurant name..." name="search">
                    <button class="input-group-text text-body search_btn" type="submit"><i class="fas fa-search "
                            aria-hidden="true"></i></button>
                    <a href='{{ route('index') }}' class="input-group-text text-body search_btn text-decoration-none"
                        type="submit"><i class="fas fa-sync-alt"></i></a>
                </div>
            </form>
            <div class="row" id='restaurant-list'>
                @if (count($restaurants) > 0)
                    <div class="d-flex justify-content-between">
                        <h4 class="text-color">All Restaurants</h4>
                    </div>

                    @foreach ($restaurants as $restaurant)
                        <div class="col-lg-3 col-sm-6  pt-4">
                            <a href="{{ route('fooditem.show', [base64_encode($restaurant->id)]) }}" class='text-decoration-none text-dark'>

                                <div class="card mx-2 rounded-4 overflow-hidden border-0 shadow restaurant-card ">
                                    <div class="img-wrapper">
                                        {{-- <img class="inner-img " src="{{ asset('uploads/images/' . $restaurant->image) }}" /> --}}
                                        <img class="inner-img " src="{{ asset('uploads/images/' . $restaurant->thumbnail) }}" />
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

    <div class="modal modal-xl fade" id="review_modal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="review_modal_label" aria-hidden="true">

        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="review_modal_label">Select your City</h1>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-header">

                    {{-- <input type="search" class='form-control' placeholder="Search for your city"> --}}
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search for your city" id="search">
                        <button class="input-group-text text-body bg-transparent" type="button">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('rating.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p class='text-center text-danger'>Popular Cities</p>
                        <div class="row">
                            @foreach ($cities as $city)
                                {{-- <div class="col-lg-2 col-sm-6 citys city" data-city="{{ $city->city_name }}">
                                        {{ $city->city_name }}
                                    </div> --}}
                                <div class="col cities mx-auto text-center">
                                    {{-- <img class='city' data-city="{{ $city->city_name }}" src="{{ asset('assets/images/ahd.png') }}" --}}


                                    @if (isset($city->image))
                                        <img class='city city_image mx-auto text-center' data-city="{{ $city->city_name }}"
                                            src="{{ asset('uploads/images/' . $city->image) }}" alt="">
                                    @endif
                                    <p class='city  text-center' data-city="{{ $city->city_name }}">{{ $city->city_name }}
                                    </p>
                                </div>
                            @endforeach
                            {{-- <div class="col">
                                <img class='city' data-city="Abohar" src="{{ asset('assets/images/ahd.png') }}"
                                    alt="">
                                <p class='text-center city' data-city="Abohar">Abohar</p>
                            </div>
                            <div class="col">
                                <img class='city' data-city="Amritsar" src="{{ asset('assets/images/bang.png') }}"
                                    alt="">
                                <p class='text-center city' data-city="Amritsar">Amritsar</p>

                            </div>
                            <div class="col">
                                <img class='city' data-city="Chandigarh" src="{{ asset('assets/images/chd.png') }}"
                                    alt="">
                                <p class='text-center city' data-city="Chandigarh">Chandigarh</p>

                            </div>
                            <div class="col">
                                <img class='city' data-city="Ludhiana" src="{{ asset('assets/images/chen.png') }}"
                                    alt="">
                                <p class='text-center city' data-city="Ludhiana">Ludhiana</p>

                            </div>
                            <div class="col">
                                <img class='city' data-city="Hyderabad" src="{{ asset('assets/images/hyd.png') }}"
                                    alt="">
                                <p class='text-center city' data-city="Hyderabad">Hyderabad</p>

                            </div>
                            <div class="col">
                                <img class='city' data-city="Kochi" src="{{ asset('assets/images/koch.jpeg') }}"
                                    alt="">
                                <p class='text-center city' data-city="Kochi">Kochi</p>

                            </div>
                            <div class="col">
                                <img class='city' data-city="Kolkata" src="{{ asset('assets/images/kolk.png') }}"
                                    alt="">
                                <p class='text-center city' data-city="Kolkata">Kolkata</p>

                            </div>
                            <div class="col">
                                <img class='city' data-city="Mumbai" src="{{ asset('assets/images/mumbai.png') }}"
                                    alt="">
                                <p class='text-center city' data-city="Mumbai">Mumbai</p>

                            </div>
                            <div class="col">
                                <img class='city' data-city="Delhi" src="{{ asset('assets/images/ncr.png') }}"
                                    alt="">
                                <p class='text-center city' data-city="Delhi">Delhi-ncr</p>

                            </div> --}}
                            {{-- <div class="col">
                                <img class='city' data-city="Pune"
                                    src="{{ asset('assets/images/pune-selected.png') }}" alt="">
                                <p class='text-center city' data-city="Pune">Pune</p>

                            </div> --}}
                        </div>

                        <p class='text-center text-danger d-none' id='view_all_city'>Other Cities</p>

                        <div class="row" id='all_city' style='display:none'>
                            <div class='row'>

                                @foreach (range('A', 'Z') as $letter)
                                    <small class='city_latter col' data-alphabet="{{ $letter }}">{{ $letter }}
                                    </small>
                                @endforeach

                            </div>

                            <div class="row">
                                @foreach ($cities as $city)
                                    <div class="col-lg-2 col-sm-6 citys city" data-city="{{ $city->city_name }}">
                                        {{ $city->city_name }}
                                    </div>
                                @endforeach
                            </div>

                            <p class='text-center text-danger' id='hide_all_city'>Hide All City</p>
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

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}

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
        document.addEventListener('DOMContentLoaded', function() {

            var cities = document.querySelectorAll('.citys');
            cities.forEach(function(city) {
                city.style.display = 'block';
            });
            var letters = document.querySelectorAll('.city_latter');
            letters.forEach(function(letter) {
                letter.addEventListener('click', function() {
                    var selectedAlphabet = letter.dataset.alphabet;
                    cities.forEach(function(city) {
                        city.style.display = 'none';
                    });

                    var selectedCities = document.querySelectorAll('.citys[data-city^="' +
                        selectedAlphabet + '"]');
                    selectedCities.forEach(function(city) {
                        city.style.display = 'block';
                    });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var cityElements = document.querySelectorAll('.city');
            var searchInput = document.getElementById('search');

            searchInput.addEventListener('input', function() {
                var searchQuery = this.value.toLowerCase();

                cityElements.forEach(function(cityElement) {
                    var cityName = cityElement.dataset.city.toLowerCase();
                    var isMatch = cityName.includes(searchQuery);

                    cityElement.style.display = isMatch ? 'block' : 'none';
                });
            });


            var cities = document.querySelectorAll('.citys');
            cities.forEach(function(city) {
                city.style.display = 'block';
            });
            var letters = document.querySelectorAll('.city_latter');
            letters.forEach(function(letter) {
                letter.addEventListener('click', function() {
                    var selectedAlphabet = letter.dataset.alphabet;
                    cities.forEach(function(city) {
                        city.style.display = 'none';
                    });

                    var selectedCities = document.querySelectorAll('.citys[data-city^="' +
                        selectedAlphabet + '"]');
                    selectedCities.forEach(function(city) {
                        city.style.display = 'block';
                    });
                });
            });
        });


        var cityElements = document.querySelectorAll('.city');

        cityElements.forEach(function(cityElement) {
            cityElement.addEventListener('click', function() {
                var cityName = cityElement.getAttribute('data-city');
                localStorage.setItem('selectedCity', cityName);

                var storedCity = localStorage.getItem('selectedCity');

                var select_city_name = document.getElementById('select_city_name');

                select_city_name.textContent = storedCity;
                select_city_name.textContent = storedCity || 'Select your city';
                var select_city_name_sm = document.getElementById('select_city_name_sm');
            select_city_name_sm.textContent = storedCity || 'Select your city';
                $.ajax({
                    url: "{{ route('select_city') }}",
                    type: "POST",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'city_name': cityName,
                    },
                    success: function(response) {

                        var restaurantList = $('#restaurant-list');

                        restaurantList.empty();
                        if (response.restaurants.length > 0) {


                            $.each(response.restaurants, function(index, restaurant) {
                                var restaurantHtml =
                                    '<div class="col-lg-3 col-sm-6 pt-5">';
                                restaurantHtml += '<a href="/fooditem/' + btoa(
                                        restaurant.id) +
                                    '" class="text-decoration-none text-dark">';
                                restaurantHtml +=
                                    '<div class="card mx-2 rounded-4 overflow-hidden border-0 shadow restaurant-card ">';
                                restaurantHtml += '<div class="img-wrapper">';
                                restaurantHtml +=
                                    '<img class="inner-img" src="{{ asset('uploads/images/') }}/' +
                                    restaurant.thumbnail + '" />';
                                restaurantHtml += '</div>';
                                restaurantHtml += '<div class="card-body">';
                                restaurantHtml += '<h4 class="text-truncate">' +
                                    restaurant.restaurant_name + '</h4>';
                                restaurantHtml += '<p class="text-truncate">' +
                                    restaurant.location + '</p>';
                                restaurantHtml += '<div class="d-flex">';
                                restaurantHtml +=
                                    '<h4 class="restaurant_type mt-2 d-flex align-items-center justify-content-center" style="background-color: ' +
                                    (restaurant.restaurant_type === 'veg' ? 'green' :
                                        'red') + ';">';
                                restaurantHtml += '</h4>';
                                restaurantHtml += '<span class="ms-2">' + restaurant
                                    .restaurant_type + '</span>';
                                restaurantHtml += '</div>';
                                restaurantHtml += '</div>';
                                restaurantHtml += '</div></a></div>';

                                restaurantList.append(restaurantHtml);
                            });
                        } else {
                            var noRestaurantHtml =
                                '<div class="col-12"><h4 class="text-color">Restaurant Not Found</h4></div>';
                            restaurantList.append(noRestaurantHtml);
                        }
                    },
                    error: function(response) {
                        console.log('error');
                    }
                });
                $('#review_modal').modal('hide');
            });
        });

        // console.log(storedCity);
        $("#view_all_city").click(function() {
            $("#all_city").show();
        });
        $("#hide_all_city").click(function() {
            $("#all_city").hide();
        });
        $(document).ready(function() {
            var cityName = localStorage.getItem('selectedCity');
            var select_city_name = document.getElementById('select_city_name');
                 select_city_name.textContent = cityName || 'Select your city';

            var select_city_name_sm = document.getElementById('select_city_name_sm');
            select_city_name_sm.textContent = cityName || 'Select your city';
             if (!cityName) {


                $('#review_modal').modal('show');
            }
        });
    </script>
@endsection
