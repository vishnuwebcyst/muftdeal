@extends('layouts.restaurant')


@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <style>
        ul {
            list-style-type: none;

        }

        .menu_qrcode {
            width: 300px !important;
        }

        .min-height-300 {
            min-height: 80px !important;
        }

        img {
            margin: auto;
            width: auto;
        }
    </style>

    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start"> </aside>
        <main class="main-content position-relative border-radius-lg">
            <div class="container-fluid py-4">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3 my-5">
                    <div class="col-lg-3 col-md-4 col-sm-12 ">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_offer" class="text-decoration-none">
                            <div class="card fw-bold text-center bg-primary text-white">
                                <div class="card-body box2">
                                    <div>
                                        <h4 class="text-white">Add Offer</h4>
                                        <span class='text-white'>click here</span>
                                        <!-- Modal -->
                                        <div class="modal fade" id="add_offer" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>Add Offer</h4>
                                                        <a href="#" class="ms-auto" data-bs-dismiss="modal"><i
                                                                class="fas fa-times fs-4"></i></a>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <div class="card card-plain">
                                                            <div class="card-body pb-3 text-dark  ">
                                                                <form action="{{ route('restaurant.offer') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <div class='mb-3'>
                                                                        <label for="offers">Enter Valid Offers</label>
                                                                        <input name="offers" type='text'
                                                                            class='form-control'
                                                                            value='{{ $restaurant->offers }}'
                                                                            placeholder="Enter Offer">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Add
                                                                        Offers</button>
                                                                </form>
                                                                @if (isset($restaurant->offers))
                                                                    <form action="{{ route('restaurant.offer_delete') }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger">Delete
                                                                            Offers</button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 ">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            class="text-decoration-none">
                            <div class="card fw-bold text-center bg-primary text-white">
                                <div class="card-body box2">
                                    <div>
                                        <h4 class="text-white">Share Link </h4>
                                        <span class='text-white'>click here</span>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>Menu Qr Code</h4>
                                                        <a href="#" class="ms-auto" data-bs-dismiss="modal"><i
                                                                class="fas fa-times fs-4"></i></a>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <div class="card card-plain">
                                                            <div class="card-body pb-3 text-dark">
                                                                <div class="col-md-12 mx-auto py-3 ">
                                                                    <div>
                                                                        <div class='mx-auto text-center w-100 menu_qrcode'
                                                                            id="qrcode">
                                                                        </div>
                                                                        <canvas class='d-none' id="combinedCanvas" width="1300" height="1850"></canvas>
                                                                    </div>
                                                                </div>
                                                                <button id="downloadLink" class='btn btn-primary'>Download
                                                                    QR Code</button>

                                                                <div id="additional-text"
                                                                    style="margin-top:30px; font-size: 20px;">For more info,
                                                                    contact us: +91 98880-49484</div>
                                                                <p class='d-none' id="additional-text"></p>
                                                                <p class="text-start">Copy below link and share with your
                                                                    friends.</p>
                                                                <form action="">
                                                                    <input type="text" name="link" id="myInput"
                                                                        class="form-control shadow-none"
                                                                        value="{{ url('/') }}/{{ base64_encode($restaurant->id) }}">
                                                                    <button type="button"
                                                                        class="btn btn-primary float-end mt-2"
                                                                        onclick="copyToClipboard()">Copy Link</button>
                                                                    <a href="https://api.whatsapp.com/send?text={{ url('/') }}/{{ base64_encode($restaurant->id) }}"
                                                                        class="btn btn-primary  float-end mt-2 me-2"
                                                                        target="blank"><i
                                                                            class="fab fa-whatsapp fs-5"></i></a>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 ">
                        <a href="{{ route('restaurant-menu.show', [auth()->guard('restaurant')->user()->id]) }}"
                            class="text-decoration-none">
                            <div class="card fw-bold text-center bg-primary">
                                <div class="card-body">
                                    <h4 class='text-white'>Total Products </h4>
                                    <span class='text-white'>{{ $total_menu }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 ">
                        {{-- <a href="{{ route('restaurant-menu.create', ['restaurant_id' => request('restaurant_id')]) }}" --}}
                        <a href="{{ route('restaurant-menu.create', ['restaurant_id' => $restaurant->id]) }}"
                            class="text-decoration-none">
                            <div class="card fw-bold text-center bg-primary">
                                <div class="card-body">
                                    <h4 class='text-white'>Add New Product </h4>
                                    <span class='text-white'>click here</span>

                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 ">
                        <a href="{{ route('view') }}" class="text-decoration-none">
                            <div class="card fw-bold text-center bg-primary ">
                                <div class="card-body">
                                    <h4 class='text-white'>View Menu </h4>
                                    <span class='text-white'>click here</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 ">
                        <a href="{{ route('food-types.create', ['restaurant_id' => $restaurant->id]) }}"
                            class="text-decoration-none">
                            <div class="card fw-bold text-center bg-primary">
                                <div class="card-body">
                                    <h4 class='text-white'>Add New category </h4>
                                    <span class='text-white'>click here</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </main>
        <script>
            function copyToClipboard() {
                var copyText = document.getElementById("myInput");
                window.navigator.clipboard.writeText(copyText.value);
                alert("Copied");
            }
        </script>
        {{-- <script>
            document.addEventListener("DOMContentLoaded", function() {
                var restaurant_id = window.btoa({{ $restaurant->id }});
                var link = "";

                generateQRCode("https://muftdeal.com/" + restaurant_id, link);
            });

            function generateQRCode(text, additionalLink) {
                var qrcode = new QRCode(document.getElementById("qrcode"), {
                    text: text,
                    width: 150,
                    height: 150,
                });

                document.getElementById("additional-text").innerHTML = additionalLink;

                document.getElementById("downloadLink").addEventListener("click", function() {
                    var container = document.getElementById("qrcode");

                    var dataURL = container.getElementsByTagName("img")[0].src;
                    var randomImageURL = "http://localhost:8000/assets/images/Code-Format.png";
                    // var randomImageURL = "http://muftdeal.com/assets/images/Code-Format.png";

                    var combinedCanvas = document.getElementById("combinedCanvas");
                    var context = combinedCanvas.getContext('2d');
                    var randomImage = new Image();
                    randomImage.crossOrigin = "Anonymous";
                    randomImage.src = randomImageURL;

                    randomImage.onload = function() {
                        context.drawImage(randomImage, 0, 0, combinedCanvas.width, combinedCanvas.height);

                        var qrCodeImage = new Image();
                        qrCodeImage.src = dataURL;

                        var qrCodeWidth = 200;
                        var qrCodeHeight = 170;

                        var marginTop = 60;
                        var marginLeft = 50;

                        context.drawImage(qrCodeImage, marginLeft, marginTop, qrCodeWidth, qrCodeHeight);

                        context.font = '15px Arial';
                        context.fillStyle = 'white';
                        context.fillText(additionalLink, 10, 170);

                        var imageDataURL = combinedCanvas.toDataURL("image/png");
                        var link = document.createElement("a");
                        link.href = imageDataURL;
                        link.download = "{{ $restaurant->restaurant_name }}.png";
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    };
                });
            }
        </script> --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var restaurant_id = window.btoa({{ $restaurant->id }});
                var link = "";

                generateQRCode("https://muftdeal.com/" + restaurant_id, link);
            });

            function generateQRCode(text, additionalLink) {
                var qrcode = new QRCode(document.getElementById("qrcode"), {
                    text: text,
                    width: 200,
                    height: 200,
                });

                document.getElementById("additional-text").innerHTML = additionalLink;

                document.getElementById("downloadLink").addEventListener("click", function() {
                    var container = document.getElementById("qrcode");

                    var dataURL = container.getElementsByTagName("img")[0].src;
                    // var randomImageURL = "http://localhost:8000/assets/images/Code-Format.png";
                    var randomImageURL = "http://muftdeal.com/assets/images/Code-Format.png";

                    var combinedCanvas = document.getElementById("combinedCanvas");
                    var context = combinedCanvas.getContext('2d');
                    var randomImage = new Image();
                    randomImage.crossOrigin = "Anonymous";
                    randomImage.src = randomImageURL;

                    randomImage.onload = function() {

                        var originalWidth = randomImage.width;
                        var originalHeight = randomImage.height;

                        var desiredWidth = 1200;
                        var scaleFactor = desiredWidth / originalWidth;

                        var scaledHeight = originalHeight * scaleFactor;

                        context.drawImage(randomImage, 0, 0, desiredWidth, scaledHeight);

                        var qrCodeImage = new Image();
                        qrCodeImage.src = dataURL;

                        var qrCodeWidth = 850;
                        var qrCodeHeight = 850;

                        var marginTop = 270;
                        var marginLeft = 180;

                        context.drawImage(qrCodeImage, marginLeft, marginTop, qrCodeWidth, qrCodeHeight);

                        context.font = '15px Arial';
                        context.fillStyle = 'white';
                        context.fillText(additionalLink, 10, 170);

                        var imageDataURL = combinedCanvas.toDataURL("image/png");
                        var link = document.createElement("a");
                        link.href = imageDataURL;
                        link.download = "{{ $restaurant->restaurant_name }}.png";
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    };
                });
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @endsection
