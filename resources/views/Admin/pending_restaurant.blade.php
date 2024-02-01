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
                                        <th>Phone</th>
                                        <th>Password</th>


                                        <th>Date</th>
                                        <th>Action</th>
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
                                                <img src="{{ asset('uploads/images/' . $restaurant->image) }}"
                                                    class="cstm_imagerestaurant" alt="Restaurant Image">
                                            </td>
                                            <td>{{ $restaurant->phone }}</td>
                                            <td>{{ $restaurant->show_pass }}</td>
                                            <td>{{ $restaurant->created_at }}</td>
                                            <td>
                                                <a   href="#" class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#myModal{{ $restaurant->id }}"  >Accept</a>

                                                <div class="modal fade"id="myModal{{ $restaurant->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body p-0">
                                                                <div class="card card-plain">
                                                                    <div class="modal-header">
                                                                        <h4>Confirm Url</h4>
                                                                        <a data-bs-dismiss="modal" aria-label="Close">
                                                                            <i class="fas fa-times"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="card-body  ">
                                                                        <form action="{{ route('restaurant.verified', [$restaurant->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class='mb-3'>
                                                                                <label for="url">Enter URL</label>

                                                                                <input type="text" name='url' class='form-control' placeholder="Enter url" required>
                                                                            </div>
                                                                            <button type='submit' class='btn btn-primary'>Accept</button>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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
