@extends('layouts.restaurant')

@section('content')
    <body class="g-sidenav-show   bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start">
        </aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container py-4 mt-5">
                <div class="card  px-2 p-md-5 mx-auto">
                    <div class="row">
                        <div class="col-lg-6 text-center p-2 p-md-0 text-md-end">
                            <h4 class=''>All Sliders</h4>
                        </div>
                        <div class="col-lg-6 text-center p-2 p-md-0 text-md-end">
                            <a class="btn btn-primary" href="{{ route('restaurant-sliders.create') }}">Add Slider</a>
                        </div>
                    </div>
                         <div class="owl-carousel owl-theme">
                            @foreach ($sliders as $background)
                                <div class="item ">
                                    <div class='postion-relative'>
                                        <div class="image-container">
                                            <img src="{{ asset($background->image) }}" alt="Image" class="img-fluid">
                                             <div class="image-text">
                                                 <form action="{{ route('restaurant-sliders.destroy', [$background->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button id="sliderBtn" type="submit" title='Delete Slider Image' class='border-0   text-white bg-transparent rounded-pill' onclick="return confirm('Are you sure want to delete slider image')"><i
                                                            class="fas fa-trash-alt fs-4"></i></button>
                                                </form>
                                                <button id="sliderBtn1" data-toggle="modal"
                                                data-target="#imageModal{{ $background->id }}"
                                                data-image="{{ asset($background->image) }}"
                                                data-delete-url="{{ route('background.destroy', ['background' => $background->id]) }}"
                                                class="border-0 text-white bg-transparent rounded-pill open-modal"
                                                title="View Image">
                                                <i class="fas fa-eye  fs-4"></i>
                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                     </div>
                </div>
            </div>
        </main>
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Slider Image</h4>
                    <a href="#" class="ms-auto p-0" data-bs-dismiss="modal"><i class="fas fa-times fs-4"></i></a>

                </div>
                <div class="modal-body mx-auto ">
                    <img src="" alt="Full-Screen Image" class="img-fluid modal_image" id="modalImage">
                </div>
            </div>
        </div>
    </div>
        <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/js/owl.carousel.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.open-modal').on('click', function() {
                    var imageUrl = $(this).data('image');

                    $('#modalImage').attr('src', imageUrl);

                    $('#imageModal').modal('show');
                });
            });
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
                        items:2
                    }
                }
            })
        </script>
    @endsection
