@extends('layouts.restaurant')

@section('content')

    <body class="g-sidenav-show   bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start">
        </aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container py-4 my-5">
                <div class="row">
                    <div class="">
                        <div class="card">
                            <div class="card-header  ">
                                <a href="{{ route('food-types.create', ['restaurant_id' => request('restaurant_id')]) }}"
                                    class="btn btn-primary float-end">Add New Category </a>
                                <h4 class='text-center '>Add New Product</h4>

                            </div>


                            <div class=" col-lg-8 col-12 mx-auto">
                                <form action="{{ route('restaurant-menu.store') }}" method="post" class="px-3" enctype="multipart/form-data">
                                    @csrf
                                    <input class="form-control" type="hidden" name="restaurant_id" value="{{ $restaurant_id }}">

                                    <div class="form-group">
                                        <label for="food_id" class="form-control-label">Category Name</label>
                                        <select class="form-select shadow-none" id="food_id" name="food_id" aria-label="Default select example" required>
                                            <option disabled selected>Select Category Name</option>
                                            @foreach ($data as $type)
                                                <option value="{{ $type->id }}">{{ $type->food_type }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('food_id'))
                                            <small class="text-danger">{{ $errors->first('food_id') }}</small>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="item_name" class="form-control-label">Product  Name</label>
                                        <input class="form-control" type="text" name="item_name" placeholder="Enter Product Name">
                                        @if ($errors->has('item_name'))
                                            <small class="text-danger">{{ $errors->first('item_name') }}</small>
                                        @endif
                                    </div>

                                    <div class="price-fields" style="display: none;">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                                    <script>
                                        $(document).ready(function () {
                                            $('#food_id').change(function () {
                                                var foodType = $(this).val();
                                                var itemTypes = {!! json_encode($data->pluck('item_type', 'id')->all(), JSON_HEX_TAG) !!};

                                                $('.price-fields').empty(); // Clear existing fields

                                                if (itemTypes[foodType]) {
                                                    var prices = JSON.parse(itemTypes[foodType]);

                                                    prices.forEach(function (price, index) {
                                                        var label = price + ' Price';
                                                        var inputName = index === 0 ? 'small_price' : (index === 1 ? 'medium_price' : 'large_price');
                                                        var inputField = '<div class="form-group">' +
                                                                            '<label class="form-control-label">' + label + '</label>' +
                                                                            '<input class="form-control" type="text" name="' + inputName + '"placeholder="Enter ' + label + '">' +
                                                                        '</div>';
                                                        $('.price-fields').append(inputField);
                                                    });

                                                    $('.price-fields').show();
                                                } else {
                                                    $('.price-fields').hide();
                                                }
                                            });
                                        });
                                    </script>
    @endsection
