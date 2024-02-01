@extends('layouts.restaurant')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/owl.theme.default.css') }}">
    <style>
        .cstm_imagerestaurant {
            height: 300px;
            width: 100% !important;
            object-fit: cover;
        }

        .restaurant_image {
            /* height: 100px; */
            width: 150px;
            object-fit: contain;
        }

        .table td,
        .table th {
            white-space: inherit !important;
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
            /* font-weight: 700px !important; */
        }

        .table {
            color: none !important;
        }

        .owl-prev {
            position: absolute;
            top: 45%;
            left: 30px;
            font-size: 70px !important;
            transform: translateY(-50%);
            color: white !important;
        }

        .owl-next {
            position: absolute;
            top: 45%;
            right: 30px;
            font-size: 70px !important;
            transform: translateY(-50%);
            color: white !important;
        }

        .owl-next:hover {
            background-color: transparent !important;
            color: white !important;
        }

        .owl-prev:hover {
            background-color: transparent !important;
            color: white !important;
        }

        .table>:not(caption)>*>* {
            padding: .5rem !important;
        }

        .menu-font {
            font-weight: 400;
        }

        #selectedImageContainer {
            background-repeat: repeat;
            background-size: 100%;
            background-size: contain;


        }


        @media only screen and (max-width: 600px) {
            .table {
                width: 100% !important;
            }
        }

        .food_types {
            margin-top: 1.5rem;
            font-size: calc(1.325rem + .9vw) !important;
            display: block;
        }
    </style>
    @if (!empty($data->background))
        <style>
            .item_colors {
                color: {{ $data->background->item_color }} !important;
            }

            .price_colors {
                color: {{ $data->background->price_color }} !important;
            }

            #selectedImageContainer {
                color: {{ $data->background->color }} !important;
                background-repeat: repeat;
                /* background-repeat: no-repeat !important; */
                background-size: 100%;
                background-image: url('{{ asset($data->background->image) }}');
            }
        </style>
    @endif

    <div class="modal fade" id="selectbackimage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class=" modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="selectbackimagelabel">Select Image</h1>
                    <a href="#" class="ms-auto" data-bs-dismiss="modal"><i class="fas fa-times fs-4"></i></a>
                </div>
                <div class="modal-body">
                    <div class="owl-carousel owl-theme">
                        @foreach ($menubackground as $background)
                            <div class="item">
                                <a class="dropdown-item" href="#">
                                    <img src="{{ asset($background->image) }}" alt="Menu Background Image"
                                        class="image_select cstm_imagerestaurant" id="selectimage"
                                        data-image-id="{{ $background->id }}" data-dismiss="modal">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside class="sidenav   fixed-start  ">
    </aside>
    <main class="main-content position-relative border-radius-lg ">
        <div class="container-fluid py-4  ">
            <div class="card">
                <div class="row p-lg-5 p-3">
                    <div class='d-lg-flex d-block justify-content-between'>
                        @if(!empty($data->background_id))
                        <form action="{{route('restaurant.remove_background')}}" method='post'>
                            @csrf()

                            <button type='submit' class='btn btn-primary '>Remove Background Image</button>
                        </form>
                        @endif
                        <button class="btn btn-primary  " type="button" data-bs-toggle="modal"
                            data-bs-target="#selectbackimage"> Select Background Image </button>
                    </div>
                    <div class="col-lg-8 col-md-10  mt-3 mx-auto" id="selectedImageContainer">
                        <div class="menu">
                            <div class="">
                                <div class="shadow-lg px-lg-5  px-sm-0 px-md-2">
                                    <div class=" px-sm-0 px-md-2 py-5">
                                        @if (isset($data->offers))
                                            <span class='h4 border-bottom text-white'>Offers</span>
                                            <marquee width="100%" direction="left" height="100px" class='h4 text-danger'>
                                                {{ $data->offers }}
                                            </marquee>
                                        @endif
                                        <div class="mx-auto text-center ">
                                            <img src="{{ asset('uploads/images/' . $data->image) }}"alt="Restauant Image"
                                                class="restaurant_image" />
                                        </div>
                                        <p class="text-center restaurant_name fs-1 fw-bold py-3">
                                            {{ $data->restaurant_name }}</p>
                                        <div class="table-responsive menu-font pb-5">
                                            <table class="table menu-font">
                                                <thead class="border-bottom">
                                                    <tr>
                                                        <td class="fs-3 fw-semibold">Items</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($foodTypes as $foodType)
                                                        <tr>
                                                            {{-- <td colspan="5" class="food_types "><strong class='text-danger border-bottom'>{{ $foodType->food_type }}</strong>
                                                            </td> --}}
                                                        <tr>
                                                            <td colspan="1" class=" fs-2">
                                                                <strong
                                                                    class="text-danger border-bottom">{{ $foodType->food_type }}</strong>
                                                            </td>
                                                            @foreach (json_decode($foodType->item_type) as $itemType)
                                                                <td class='mt-5 text-danger fw-bold'>{{ $itemType }}
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                        </tr>
                                                        @if ($menuGrouped->has($foodType->id))
                                                            @foreach ($menuGrouped[$foodType->id] as $item)
                                                                <tr>
                                                                    <td class="item_colors">{{ $item->item_name }}</td>
                                                                    {{-- @if (isset($item->small_price))
                                                                        <td>{{ $item->small_price . '/-' }}</td>
                                                                    @endif
                                                                    @if (isset($item->medium_price))
                                                                        <td>{{ $item->medium_price . '/-' }}</td>
                                                                    @endif
                                                                    @if (isset($item->large_price))
                                                                        <td>{{ $item->large_price . '/-' }}</td>
                                                                    @endif --}}
                                                                    <td class="price_colors">{{ isset($item->small_price) ? $item->small_price . '/-' : '' }}
                                                                    </td>
                                                                    <td class="price_colors">{{ isset($item->medium_price) ? $item->medium_price . '/-' : '' }}
                                                                    </td>
                                                                    <td class="price_colors">{{ isset($item->large_price) ? $item->large_price . '/-' : '' }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="5">No items found for this food type</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                        if ($data->menu_number == null) {
                                            $number = $data->phone;
                                        } else {
                                            $number = $data->menu_number;
                                        }
                                        ?>
                                        <div class="pt-5 text-center  ">
                                            <p class="m-0 menu-font  ">Contact for advance bookings: {{ $number }},
                                            </p>
                                            <p class="m-0 menu-font ">Location: {{ $data->location }}</p>
                                            {{-- <p class="m-0 menu-font ">Order online: {{ $data->url }}</p> --}}
                                        </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/owl.carousel.min.js') }}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            mouseDrag: false,
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
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.cstm_imagerestaurant').on('click', function() {
                $.ajax({
                    url: "{{ route('select-image') }}",
                    type: "POST",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'image_id': $(this).data('image-id'),
                        'restaurant_id': {{ $data->id }},
                    },
                    success: function(response) {
                        var imageUrl = response.image_url;
                        var textColor = response.text_color;
                        var newBackground = "url('/" + imageUrl + "')";
                        $("#selectedImageContainer").css("background-image", newBackground);
                        $("#selectedImageContainer").css("color", textColor);
                        $("tbody").css("color", textColor);
                        $("thead").css("color", textColor);
                        $(".restaurant_name").css("color", textColor);
                        $('#selectbackimage').modal('hide');
                    },
                    error: function(response) {
                        console.log('error');
                    }
                });
            });
        });
    </script>
@endsection
