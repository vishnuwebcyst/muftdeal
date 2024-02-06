@extends('layouts.app')
@section('content')

    <style>
        #selectedImageContainer {
            background-repeat: repeat;
            background-size: 100%;
            background-size: contain;
        }

        .table>:not(caption)>*>* {
            background-color: transparent !important;
        }

        .footer_img {
            width: 100px;
            height: 100px;
        }

        li {
            display: inline;
        }

        /* component */

        .star-rating {

            display: flex;
            flex-direction: row-reverse;
            font-size: 1.5em;
            justify-content: space-around;
            padding: 0 .2em;
            text-align: center;

        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ccc;
            cursor: pointer;
        }

        .star-rating :checked~label {
            color: red;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: red;
        }

        /* explanation */

        article {
            background-color: #ffe;
            box-shadow: 0 0 1em 1px rgba(0, 0, 0, .25);
            color: #006;
            font-family: cursive;
            font-style: italic;
            margin: 4em;
            max-width: 30em;
            padding: 2em;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr,
        th {
            border-color: none !important;
            border-style: none !important;
            border-width: none !important;
            font-size: 18px !important;
        }

        .menu-image {
            width: 150px;
            object-fit: contain !important;
        }

        @media (min-width: 400px) {
            .fw-bolder {
                font-size: 22px !important;
            }
        }

        .search_btn {
            background-color: #FF0032 !important;
            color: white !important;
        }
    </style>
    @if (!empty($data->background))
        <style>
            .table>:not(caption)>*>* {
                color: {{ $data->background->color }} !important;
            }

            #selectedImageContainer {
                background-repeat: repeat;
                color: {{ $data->background->color }} !important;
                background-size: 100%;
                background-image: url('{{ asset($data->background->image) }}');
            }
        </style>
    @endif
    <section class="header">
        <div class="container">
            <div class="owl-carousel owl-theme">
                @foreach ($sliders as $slider)
                    <div class="item"><img src="{{ asset($slider->image) }}" alt=""></div>
                @endforeach
            </div>
        </div>
    </section>
    <main class="main-content position-relative border-radius-lg ">
        <div class="container">
            {{-- <p class='bg-dark text-white text-center'>Designed By <a href='https://www.websyst.in/' class='text-primary text-decoration-none'>Websyst</a> </p> --}}
            {{-- @auth
                @if ($menu->rating > 0)
                    <p>You have already submitted a review with a rating of {{ $menu->rating }}.</p>
                @endauth
            @endif --}}
            {{-- <button class=' btn head-btn fw-bold' data-bs-toggle="modal" data-bs-target="#review_modal">
                <i class="fas fa-star"></i> write a review </button> --}}

            <div class="">
                <div class="row p-lg-2">
                    <div class="col-lg-8 col-md-10  mx-auto">

                        <div class="menu shadow-lg" id="selectedImageContainer">
                            <div class="">
                                <div class=" px-lg-5 px-sm-0 px-md-2 ">
                                    <div class="   px-sm-0 px-md-2 py-3 ">
                                        @if (isset($data->offers))
                                            <span class='h4 border-bottom'>Offers</span>
                                            <marquee width="100%" direction="left" height="100px" class='h4 text-danger'>
                                                {{ $data->offers }}
                                            </marquee>
                                        @endif

                                        <div class="d-flex justify-content-between px-4 ">
                                            <img src="{{ asset('uploads/images/' . $data->image) }}"alt=""
                                                class='menu-image' />
                                            <div class="text-center text-md-end">
                                                {!! QrCode::size(100)->backgroundColor(255, 255, 255)->margin(2)->generate(url('/', [base64_encode($data->id)])) !!}
                                            </div>
                                        </div>
                                        <p class="text-center restaurant_name fs-1 fw-bold m-0">
                                            {{ $data->restaurant_name }}
                                        </p>
                                        <?php
                                        if ($data->menu_number == null) {
                                            $number = $data->phone;
                                        } else {
                                            $number = $data->menu_number;
                                        }
                                        ?>
                                       @if(request('fooditem') == '')
                                       <p>Not Found</p>
                                       @else
                                        <p class="text-center restaurant_name  fs-3 m-0 ">For order call now :
                                            {{ $number }} </p>

                                            <p class='text-center   fs-5 '>Opening Time : {{ $data->open_time }} to
                                                {{ $data->close_time }}</p>


                                        <div class="text-center">
                                            <a href="tel:+91 {{ $number }}" class="btn head-btn fw-bold">call now</a>
                                        </div>
                                        @endif
                                    </div>
                                    <form action="" method="get" class='col-sm-12 col-lg-6 px-2 mx-auto'>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search Food"
                                                name="search">
                                            <button class="input-group-text search_btn" type="submit">Search</button>
                                            <a href="{{ route('fooditem.show', [base64_encode($data->id)]) }}"
                                                class=" ms-3 btn search_btn">Reset</a>
                                        </div>
                                    </form>
                                    <div class="table-responsive menu-font pb-5">
                                        <table class="table menu-font  mx-md-0">
                                            <thead class="border-bottom">
                                                <tr>
                                                    <td class=" fw-bolder">Items</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($foodTypes as $foodType)
                                                    @if ($menuGrouped->has($foodType->id))
                                                        <tr>
                                                            <td colspan="" class=" fs-2 ">
                                                                <strong
                                                                    class="text-danger border-bottom">{{ $foodType->food_type }}</strong>
                                                            </td>
                                                            @foreach (json_decode($foodType->item_type) as $itemType)
                                                                <td class="pt-4  fw-bold"
                                                                    style='color: rgb(220,53,69) !important; '>
                                                                    {{ $itemType }}</td>
                                                            @endforeach
                                                        </tr>
                                                    @endif
                                                    @if ($menuGrouped->has($foodType->id))
                                                        @foreach ($menuGrouped[$foodType->id] as $item)
                                                            <tr>
                                                                <td>{{ $item->item_name }}</td>
                                                                <td>
                                                                    @if (isset($item->small_price))
                                                                        {{ $item->small_price . '/-' }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($item->medium_price))
                                                                        {{ $item->medium_price . '/-' }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($item->large_price))
                                                                        {{ $item->large_price . '/-' }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $foodType->name }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="py-5 text-center">
                                        @if(isset($data->description))
                                        <h4 class='text-start'>Description : {{ $data->description }}</h4>
                                        @endif

                                        <h4 class="m-0 menu-font">If you want to order call this number :
                                            {{ $number }}</h4>
                                        <h4 class="m-0 menu-font">Location : {{ $data->location }}</h4>

                                        {{-- @if(request('fooditem/Mg=='))
                                        <h4 class="m-0 menu-font">If you want to order call this number :
                                            {{ $number }}</h4>
                                        <h4 class="m-0 menu-font">Location : {{ $data->location }}</h4>
                                        @endif --}}
                                    </div>
                                </div>
                                <div class=" container bg-dark text-white py-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class='ps-3'>Designed By</h4>
                                            <a href="https://www.websyst.in" target="_blank"> <img
                                                    src='{{ asset('assets/images/websyst_logo.png') }}' class='w-75'></a>
                                        </div>
                                        <img class='me-3 footer_img' src='{{ asset('assets/images/websyst_qr.png') }}'>
                                    </div>

                                    <h5 class='ps-3'> <a href="tel:+91 99509-89567"
                                            class="text-decoration-none text-white">Call Us : +91 99509-89567</a></h5>
                                    <marquee direction="left" class='h4 text-white  mx-3'>
                                        <ul>
                                            <li>Website Development |</li>
                                            <li>Mobile App Development |</li>
                                            <li>E-Commerce Website/App |</li>
                                            <li>UI/UX Designing |</li>
                                            <li>Graphic Designing |</li>
                                            <li>Search Engine Optimization |</li>

                                        </ul>

                                    </marquee>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </main>
    {{-- Rating Modal --}}

    <div class="modal fade" id="review_modal" tabindex="-1" aria-labelledby="review_modal_label" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="review_modal_label">Write a review</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('rating.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label>Add Rating</label>
                        <div class="star-rating">
                            <input type="hidden" name='rating' required>
                            <input type="radio" id="5-stars" name="rating" value="5" required />
                            <label for="5-stars" class="star">&#9733;</label>
                            <input type="radio" id="4-stars" name="rating" value="4" required />
                            <label for="4-stars" class="star">&#9733;</label>
                            <input type="radio" id="3-stars" name="rating" value="3" required />
                            <label for="3-stars" class="star">&#9733;</label>
                            <input type="radio" id="2-stars" name="rating" value="2" required />
                            <label for="2-stars" class="star">&#9733;</label>
                            <input type="radio" id="1-star" name="rating" value="1" required />
                            <label for="1-star" class="star">&#9733;</label>
                            <input type="hidden" name="restaurant_id" value="{{ $data->id }}">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Enter Review</label>
                            <textarea type="text" name='review' class="form-control" id="review" placeholder="Enter Review (Optional)"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Enter Your Email</label>
                            <input type="email" name="email" class='form-control' placeholder="Enter email"
                                required>
                            @if ($errors->has('email'))
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn head-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/owl.carousel.min.js') }}"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: false,
            autoplay: true,
            autoplayTimeout: 3000,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            responsive: {
                0: {
                    items: 1,
                    nav: false,
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
    <script>
        $(document).ready(function() {
            // Your existing modal setup code...

            // Handle modal close event
            $('#exampleModal').on('hide.bs.modal', function(e) {
                var form = $('#myForm');
                if (!form[0].checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                    form.addClass('was-validated');
                }
            });
        });
    </script>
@endsection
