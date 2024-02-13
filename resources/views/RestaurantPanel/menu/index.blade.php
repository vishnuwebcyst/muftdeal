@extends('layouts.restaurant')

@section('content')

    <body class="g-sidenav-show   bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav   fixed-start  ">
        </aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container-fluid py-4  ">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="card ">
                            <div class="card-header d-flex justify-content-end">
                                <a href="{{ route('restaurant-menu.create', ['restaurant_id' => $data->id]) }}"
                                    class="btn btn-primary ">Add Product</a>
                                    {{-- <a href="{{ route('item-types.index', ['restaurant_id' => $data->id]) }}"
                                        class="btn btn-primary ms-3"> Menu Types</a> --}}
                                    <a href="{{ route('food-types.index', ['restaurant_id' => $data->id]) }}"
                                        class="btn btn-primary ms-3"> categories</a>
                            </div>
                            <div class="text-center">
                                <img src="{{ asset('uploads/images/' . $data->image) }}" class="cstm_imagerestaurant"
                                    alt="Restaurant Image">
                            </div>
                            <div class="card-body" id="selectedImageContainer">
                                @foreach ($menu as $key => $data)
                                    <div class=" row  py-3 border-bottom">
                                        <div class="col-lg-6 mx-auto ">
                                            <h5> {{ $key + 1 }} Food Name : <b>{{ $data->item_name }} </b></h5>
                                            <ul>
                                                @if(isset($data->small_price))
                                                <p class="m-0">Small Price : <b>{{ $data->small_price }}</b></p>
                                                @endif
                                                @if(isset($data->medium_price))
                                                <p class="m-0">Medium Price : <b>{{ $data->medium_price }}</b></p>
                                                @endif
                                                @if(isset($data->large_price))
                                                <p class="m-0">Large Price : <b>{{ $data->large_price }}</b></p>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="  col-lg-4  ">
                                            <div class="d-flex">
                                                <a class=" mx-2 btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#myModal{{ $data->id }}"><i
                                                        class="fas fa-edit"></i></a>
                                                <form action="{{ route('restaurant-menu.destroy', [$data->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure want to delete')"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade"id="myModal{{ $data->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalSignTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <div class="card card-plain">
                                                        <div class="card-header text-center">
                                                            <h4>Edit Product</h4>
                                                        </div>
                                                        <div class="card-body pb-3">

                                                            <form role="form text-left"
                                                                action="{{ route('restaurant-menu.update', [$data->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <label>Product Name</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" name="item_name"
                                                                        class="form-control"
                                                                        value="{{ $data->item_name }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="food_id" class="form-control-label">Slect Tax (%)</label>

                                                                    <select class="form-select shadow-none" id="gst" name="gst" aria-label="Default select example" >
                                                                        <option  >Select Tax (optional)</option>

                                                                            <option value="5"  @if ($data->gst == 5) selected @endif>5%</option>
                                                                            <option value="18"   @if ($data->gst == 18) selected @endif>18 %</option>
                                                                            <option value="18"  @if ($data->gst == 28) selected @endif>28 %</option>

                                                                    </select>

                                                                </div>
                                                                @if(isset($data->small_price))
                                                                <label>Small Price</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" name='small_price'
                                                                        class="form-control"
                                                                        value="{{ $data->small_price }}">
                                                                </div>
                                                                @endif
                                                                @if(isset($data->medium_price))
                                                                <label>Medium Price</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" name='medium_price'
                                                                        class="form-control"
                                                                        value="{{ $data->medium_price }}">
                                                                </div>
                                                                @endif
                                                                @if(isset($data->large_price))
                                                                <label>Large Price</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" name='large_price'
                                                                        class="form-control"
                                                                        value="{{ $data->large_price }}">
                                                                </div>
                                                                @endif

                                                                <div class="text-center">
                                                                    <button type="submit"
                                                                        class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                           <div>
                                    {{ $menu->links() }}
                                </div>
                        </div>

                    </div>
                </div>

            </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.cstm_imagerestaurant').on('click', function() {
                    $.ajax({
                        url: "{{ route('get-image') }}",
                        type: "POST",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'image_id': $(this).data('image-id'),
                        },
                        success: function(response) {

                            var imageUrl = response.image_url;
                            var newBackground = "url('/" + imageUrl + "')";
                            $("#selectedImageContainer").css("background-image", newBackground);
                        },
                        error: function(response) {
                            console.log('error');
                        }
                    });
                });
            });
        </script>
    @endsection
