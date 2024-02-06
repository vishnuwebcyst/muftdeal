@extends('layouts.admin')

@section('content')

    <body class="g-sidenav-show   bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start"></aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container-fluid py-4  ">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="card ">


                            <div class="card-header d-flex menu_btns">
                                <a href="{{ route('menu.create', ['restaurant_id' => $data->id]) }}"
                                    class="btn btn-primary ">Add Product</a>
                                {{-- <a href="{{ route('item-type.index', ['restaurant_id' => $data->id]) }}"
                                    class="btn btn-primary ms-3"> Menu Types</a> --}}
                                <a href="{{ route('food-type.index', ['restaurant_id' => $data->id]) }}"
                                    class="btn btn-primary ms-3"> category Types</a>

                                <div class="ms-auto drop_btn">
                                    <a href="{{ route('menu.show', [$data->id]) }}" class="btn btn-primary">View Menu</a>

                                    <ul class="dropdown-menu" style="width: 200px">
                                        @foreach ($menubackground as $background)
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <img src="{{ asset($background->image) }}" alt="Menu Background Image"
                                                        class="cstm_imagerestaurant" id="selectimage"
                                                        data-image-id="{{ $background->id }}">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="text-center">
                                <img src="{{ asset('uploads/images/' . $data->image) }}" class="cstm_imagerestaurant"
                                    alt="Restaurant Image" />
                            </div>
                            <div class="card-body" id="selectedImageContainer">

                                @foreach ($menu as $key => $data)
                                    {{-- @foreach ($data->itemType as $itemType)
                                        <p class="m-0">{{ $itemType->item_type }}
                                        </p>
                                    @endforeach --}}
                                    <div class=" row  py-3 border-bottom">
                                        <div class="col-lg-6 mx-auto ">
                                            <ul>
                                                <h5><span class='pe-3'> {{ $key + 1 }}</span> Food Name :
                                                    <b>{{ $data->item_name }} </b>
                                                </h5>


                                                @if (isset($data->small_price))
                                                    <p class="m-0">Small Price
                                                        <b>{{ $data->small_price }}</b>
                                                    </p>
                                                @endif

                                                @if (isset($data->medium_price))
                                                    <p class="m-0">Medium Price :
                                                        <b>{{ $data->medium_price }}</b>
                                                    </p>
                                                @endif
                                                @if (isset($data->large_price))
                                                    <p class="m-0">Large Price :
                                                        <b>{{ $data->large_price }}</b>
                                                    </p>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="  col-lg-4  ">
                                            <div class="d-flex">
                                                <a class=" mx-2 btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#myModal{{ $data->id }}"><i
                                                        class="fas fa-edit"></i></a>
                                                <form action="{{ route('menu.destroy', ['menu' => $data->id]) }}"
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
                                                            <h4>Edit Menu</h4>
                                                        </div>
                                                        <div class="card-body pb-3">

                                                            {{-- <form role="form text-left" action="#" method="POST"> --}}

                                                            <form role="form text-left"
                                                                action="{{ route('menu.update', ['menu' => $data->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="restaurant_id"
                                                                    value="{{ $data->restaurant_id }}">
                                                                <input type="hidden" name="menu_id"
                                                                    value="{{ $data->id }}">

                                                                <div>
                                                                    <label>Food Name</label>
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" name="item_name"
                                                                            class="form-control"
                                                                            value="{{ $data->item_name }}">
                                                                    </div>
                                                                </div>
                                                                @if (isset($data->small_price))
                                                                    <div>
                                                                        <label>Small price</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" name="small_price"
                                                                                class="form-control"
                                                                                value="{{ $data->small_price }}">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if (isset($data->medium_price))
                                                                    <div>
                                                                        <label>Medium Price</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" name="medium_price"
                                                                                class="form-control"
                                                                                value="{{ $data->medium_price }}">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if (isset($data->large_price))
                                                                    <div>
                                                                        <label>Large Price</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" name="large_price"
                                                                                class="form-control"
                                                                                value="{{ $data->large_price }}">
                                                                        </div>
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
                            <div class='ms-auto px-5'>
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
