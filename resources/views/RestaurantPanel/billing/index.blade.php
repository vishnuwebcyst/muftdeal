@extends('layouts.restaurant')

@section('content')

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
                        <div class="card-header">
                            <a href='{{route("billing.create")}}' class='btn btn-primary float-end'>Add New Invoice</a>

                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0 ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th> Phone Number</th>

                                        <th>Sub Price</th>
                                        <th>GST (%)</th>
                                        <th>Discount Amount</th>
                                        <th>Total Price</th>

                                        <th>Action</th>
                                        <th>Date</th>
                                     </tr>
                                </thead>
                                <tbody class='text-center'>
                                    @foreach ($data as $key => $billing)

                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $billing->customer_name }}</td>
                                            <td>{{ $billing->customer_phone }}</td>


                                            <td>

                                                {{ $billing->grand_total }}</td>
                                            <td>{{ $billing->gst }}</td>
                                            <td>{{ $billing->discount }}</td>
                                            <td>{{  $billing->total  }}</td>
                                            <td><a href='{{route('restaurant.invoice', [$billing->id])}}' class='btn btn-primary' target="_blank">View</td>
                                                <td>{{$billing->created_at}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
{{$data->links()}}
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @endsection
