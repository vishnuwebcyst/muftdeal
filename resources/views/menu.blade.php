<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <title> Menu </title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}">

    <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard-pro" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('admin/css/nucleo-icons.css') }}" rel="stylesheet" />

    <link id="pagestyle" href="{{ asset('admin/css/argon-dashboard.min9c7f.css?v=2.0.5') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/owl.theme.default.css') }}">
    <style>
           li {
            display: inline;
        }
        .footer_img{
            height: 100px;
            width:100px;
        }


        @media (min-width: 400px) {
            .fw-bolder {
                font-size: 22px !important;
            }
        }

        .table td,
        .table th {
            white-space: inherit !important;
        }

        body {
            background-color: #fff !important;
        }

        .cstm_style {
            bottom: 10px !important;
            right: 10px ! important;
            position: absolute;
            z-index: 11111;
            background-color: #ff9090;
            color: white;
            position: fixed;


        }

        .cstm_imagerestaurant {
            height: auto;
            width: 100px;
            object-fit: cover;
        }

        .cstm_style_success {
            bottom: 10px !important;
            right: 10px ! important;
            position: absolute;
            z-index: 11111;
            background-color: green;
            color: white;
            position: fixed;


        }

        .cstm_navbar_design {
            background-color: #5e72e4 !important
        }

        .cstm_imagerestaurant {
            height: 300px;
            width: 100%;
            object-fit: cover;
        }
        .menu_footer{
            background-color:black;
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
            /* font-size: 18px !important; */
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

        .head-btn {
            background-color: #FF0032 !important;
            color: white !important;
            border-radius: 30px !important;
        }

        .food_types {
            /* padding-top: 13rem !important; */
            /* margin-top : 1.5rem !important; */
            /* display:block !important;
            font-size:calc(1.325rem + .9vw)!important; */
        }

        .search_btn {
            background-color: #FF0032 !important;
            color: white !important;
        }
    </style>
    @if (!empty($data->background))
        <style>
            #selectedImageContainer {
                color: {{ $data->background->color }} !important;
                background-repeat: repeat;
                /* background-repeat: no-repeat !important; */
                background-size: 100%;
                background-image: url('{{ asset($data->background->image) }}');
            }
        </style>
    @endif
</head>

<body>
    <main class="main-content position-relative border-radius-lg ">
        <div class="container-fluid  p-3 ">
            <div class=" ">
                <div class="row">
                    <div class="col-lg-6 col-md-10  mt-3 mx-auto p-0" >
                        <div class="menu" id="selectedImageContainer">

                                    <div class=" px-lg-5 px-sm-0 px-md-2 py-5">
                                        @if (isset($data->offers))
                                        <span class='h4 border-bottom text-white'>Offers</span>
                                        <marquee width="100%" direction="left" height="100px" class='h4 text-danger'>
                                            {{ $data->offers }}
                                        </marquee>
                                    @endif
                                        <div class="mx-auto text-center ">
                                            <img src="{{ asset('uploads/images/' . $data->image) }}"alt=""
                                                style="  width: 150px; object-fit: contain;" />
                                        </div>
                                        <p class="text-center restaurant_name fs-1 fw-bold py-3">
                                            {{ $data->restaurant_name }}</h2>
                                            <?php
                                            if ($data->menu_number == null) {
                                                $number = $data->phone;
                                            } else {
                                                $number = $data->menu_number;
                                            }
                                            ?>

                                        <p class="text-center restaurant_name  fs-3 ">For order call now :
                                            {{ $number }}</p>
                                            <p class='text-center   fs-5 '>Opening Time : {{ $data->open_time}} to {{ $data->close_time }}</p>

                                        <div class="text-center">
                                            <a href="tel:+91 {{ $number }}" class="btn head-btn fw-bold">call
                                                now</a>
                                        </div>
                                        <div class="table-responsive menu-font pb-5">
                                            <table class="table menu-font">
                                                <thead class="border-bottom">
                                                    <tr>
                                                        <td class=" fw-bolder">Items</td>
                                                        {{-- @foreach ($item_types as $item)
                                                        <td class=" fw-bolder">{{$item->type}}</td>
                                                        @endforeach --}}

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($foodTypes as $foodType)
                                                        @if ($menuGrouped->has($foodType->id))
                                                        <tr>
                                                            <td colspan="1" class=" fs-2">
                                                                <strong
                                                                    class="text-danger border-bottom">{{ $foodType->food_type }}</strong>
                                                            </td>
                                                            @foreach (json_decode($foodType->item_type) as $itemType)
                                                                <td class='mt-5 fw-bold text-danger'>{{ $itemType }}</td>
                                                            @endforeach
                                                        </tr>
                                                        @endif
                                                        @if ($menuGrouped->has($foodType->id))
                                                            @foreach ($menuGrouped[$foodType->id] as $item)
                                                                {{-- <tr>

                                                                    <td>{{ $item->item_name }}</td>
                                                                    @if (isset($item->small_price))
                                                                        <td>{{ $item->small_price . '/-' }} </td>
                                                                    @endif
                                                                    @if (isset($item->medium_price))
                                                                        <td>{{ $item->medium_price . '/-' }}</td>
                                                                    @endif
                                                                    @if (isset($item->large_price))
                                                                        <td>{{ $item->large_price . '/-' }}</td>
                                                                    @endif
                                                                    <td>{{ $foodType->name }}</td>
                                                                </tr> --}}
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
                                        <div class="pt-5 text-center">
                                            <p class="m-0 menu-font">If you want to order call this number : {{ $number }}</p>
                                                <p class="m-0 menu-font">Location : {{ $data->location }}</p>
                                        </div>
                                    </div>

                        </div>
                        <div class=" container  text-white py-3 mx-0 px-0 menu_footer" >
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class='ps-3 text-white'>Designed By</h4>
                                  <a href="https://www.websyst.in" target="_blank">  <img src='{{ asset('assets/images/websyst_logo.png') }}' class='w-75'></a>
                                </div>
                                <img class='me-3 footer_img' src='{{ asset('assets/images/websyst_qr.png') }}'>
                            </div>

                            <h5 class='ps-3'> <a href="tel:+91 99509-89567" class="text-decoration-none text-white">Call Us : +91 99509-89567</a></h5>
                             <marquee   direction="left" class='h4 text-white  mx-3'>
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
                    url: "{{ route('get-image') }}",
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
</body>

</html>
