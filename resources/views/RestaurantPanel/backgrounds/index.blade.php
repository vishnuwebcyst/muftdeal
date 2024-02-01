@extends('layouts.restaurant')
@section('content')
    <style>
        .background-image {
            height: 200px;
            width: 100px;
            object-fit: cover;
        }

        .modal_image {
            height: 500px;
            width: 1000px;
            object-fit: cover;

        }
    </style>
    <link rel="stylesheet" href="{{ asset('admin/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/owl.theme.default.css') }}">

    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start"></aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container py-4 mt-5">
                <div class="card  px-2 p-md-5 mx-auto">
                    <div class="row">
                        <div class="col-lg-6 text-center p-2 p-md-0 text-md-end">
                            <h4>Menu Backgrounds</h4>
                        </div>
                        <div class="col-lg-6 text-center p-2 p-md-0 text-md-end">
                            <a class="btn btn-primary" href="{{ route('restaurant.background_add') }}">Add Background</a>
                        </div>
                    </div>
                    <div class="owl-carousel owl-theme p-0 p-md-5">
                        @foreach ($menubackground as $background)
                            <div class="item">
                                <div class='postion-relative'>
                                    <div class="image-container">
                                       <a href="{{ asset($background->image) }}" target="_blank"> <img src="{{ asset($background->image) }}" alt="Image" class=" background-image"></a>
                                        <div class="image-text">
                                            <form action="{{ route('restaurant.background_delete', [$background->id]) }}"
                                                method="POST">
                                                @csrf

                                                <button id="sliderBtn" type="submit" title='Delete background image'
                                                class='border-0   text-white bg-transparent rounded-pill'
                                                onclick="return confirm('Are you sure want to delete slider image')"><i
                                                class="fas fa-trash-alt fs-4"></i>

                                            </button>
                                        </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </main>

        <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/js/owl.carousel.min.js') }}"></script>
        <script>
            $('.owl-carousel').owlCarousel({
                loop: false,
                margin: 10,
                nav: false,
                responsive: {
                    0: {
                        items: 1,
                        nav: false,
                    },
                    600: {
                        items: 2

                    },
                    1000: {
                        items: 3
                    }
                }
            })
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.open-modal').on('click', function() {
                    var imageUrl = $(this).data('image');

                    $('#modalImage').attr('src', imageUrl);

                    $('#imageModal').modal('show');
                });
            });
        </script>
    @endsection
