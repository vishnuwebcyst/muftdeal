@extends('layouts.admin')

@section('content')
    <style>
        .table_width {
            white-space: break-spaces !important;
        }
    </style>

    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start"> </aside>
        <main class="main-content position-relative border-radius-lg">
            <div class="container-fluid py-4">
                <form action="" method="get" class='col-sm-12 col-lg-3 p-2'>
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search restaurant..." name="search">
                        <button class="input-group-text text-body" type="submit"><i class="fas fa-search"
                                aria-hidden="true"></i></button>
                    </div>
                </form>
                <div class="row">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0 ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>City Name</th>
                                        <th>Restaurant Name</th>
                                        <th>Restaurant Type</th>
                                        <th>Restaurant Address</th>
                                        <th>Logo </th>
                                        <th>Thumbnail</th>
                                        <th>Phone</th>
                                        <th>Password</th>
                                        <th>Add Menu </th>
                                        <th>Offers</th>
                                        <th>Edit</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $restaurant)
                                        @php
                                            $dataa = $restaurant->restaurant_id;
                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $restaurant->city_name }}</td>
                                            <td class="table_width">{{ $restaurant->restaurant_name }}</td>
                                            <td class="table_width">{{ $restaurant->restaurant_type }}</td>
                                            </td>
                                            <td class="table_width">{{ $restaurant->location }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/images/' . $restaurant->image) }}" class="cstm_imagerestaurant" alt="Restaurant Logo">
                                            </td>
                                            <td>
                                                @if(!empty($restaurant->thumbnail))
                                                <img src="{{ asset('uploads/images/' . $restaurant->thumbnail) }}" class="cstm_imagerestaurant" alt="Restaurant thumbnail" >
                                                @endif
                                            </td>
                                            <td>{{ $restaurant->phone }}</td>
                                            <td>{{ $restaurant->show_pass }}</td>
                                            <td> <a href="{{ route('restaurant.show', [$restaurant->id]) }}" class="btn btn-primary shadow-lg"> Menu</a> </td>
                                            <td>

                                                <a class="btn btn-primary mx-2 " data-bs-toggle="modal" data-bs-target="#add_offer{{ $restaurant->id }}">
                                                   offers
                                                </a>
                                                <div class="modal fade"id="add_offer{{ $restaurant->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body p-0">
                                                                <div class="card card-plain">
                                                                    <div class="modal-header">
                                                                        <h4>Add Offer</h4>
                                                                        <a data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fas fa-times"></i>
                                                                        </a>

                                                                    </div>

                                                                    <div class="modal-body p-0">
                                                                        <div class="card card-plain">
                                                                            <div class="card-body pb-3 text-dark  ">
                                                                                <form action="{{ route('admin.offers',  [$restaurant->id]) }}" method="post">
                                                                                    @csrf
                                                                                    <div class='mb-3'>

                                                                                        <label for="offers">Enter Valid Offers</label>
                                                                                        <input name="offers" type='text' class='form-control'
                                                                                            value='{{ $restaurant->offers }}'>
                                                                                            <input type='hidden' name='restaurant_id' value="{{ $restaurant->id}}">
                                                                                    </div>
                                                                                    <button type="submit" class="btn btn-primary">Add Offers</button>
                                                                                </form>

                                                                                @if (isset($restaurant->offers))
                                                                                    <form action="{{ route('admin.offer_delete', [$restaurant->id]) }}" method="post">
                                                                                        @csrf
                                                                                        <button type="submit" class="btn btn-danger">Delete Offers</button>
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
                                            </td>
                                            <td>
                                                <div class='d-flex'><a
                                                        href="{{ route('restaurant.edit', [$restaurant->id]) }}" class=''><i class="fas fa-edit"></i></a>

                                                    <form action="{{ route('restaurant.destroy', ['restaurant' => $restaurant->id]) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class='border-0 bg-transparent' onclick="return confirm('Are you sure want to delete')"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                    <a class=" mx-2 " data-bs-toggle="modal" data-bs-target="#myModal{{ $restaurant->id }}">
                                                        <i class="fas fa-qrcode"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            @if ($dataa != null)
                                                <div class="modal fade"id="myModal{{ $restaurant->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body p-0">
                                                                <div class="card card-plain">
                                                                    <div class="modal-header">
                                                                        <h4>Menu Qr Code</h4>
                                                                        <a data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fas fa-times h4"></i>
                                                                        </a>

                                                                    </div>

                                                                    <div class="card-body pb-3 mx-auto text-center">
                                                                        {{-- <form action="{{ route('download.qrcode') }}" method="post">
                                                                            @csrf
                                                                             <input type="hidden" name="restauran_id" value="{{$restaurant->id}}">
                                                                            <button type="submit" class="btn btn-primary">Download Qrcode</button>
                                                                        </form> --}}

                                                                         {{-- <a href="https://api.whatsapp.com/send?text=https://muftdeal.com/{{ base64_encode($restaurant->id) }}" class="btn btn-primary" target="blank">Share</a> --}}

                                                                        <div class="col-md-12 mx-auto py-3">
                                                                            <div>
                                                                                {!! QrCode::size(250)->generate(url('/', [base64_encode($restaurant->id)])) !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="modal fade"id="myModal{{ $restaurant->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body p-0">
                                                                <div class="card card-plain">
                                                                    <div class="modal-header">
                                                                        {{-- <h4>Menu Qr Code</h4> --}}
                                                                        <a class="ms-auto" data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fas fa-times h4"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="card-body pb-3 mx-auto text-center">
                                                                        <div class="col-md-12 mx-auto  py-5 ">
                                                                            <p> <a href="{{ route('menu.create', ['restaurant_id' => $restaurant->id]) }}" class='text-decoration-underline'>Add menu</a> to see Qr Code </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <td>{{$restaurant->created_at}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $data->links() }}
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @endsection
