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

                            @if($bank_detail == 0)
                            <a href='{{ route("bank-details.create") }}' class='btn btn-primary float-end'>Add UPI Id</a>
                        @endif


                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0 ">
                                <thead>
                                    <tr>
                                        <th>Upi Id</th>

                                        <th>Action</th>
                                     </tr>
                                </thead>
                                <tbody >

                                    <tr>
                                            @if(isset($data))
                                            <td>{{ $data->upi_id }}</td>


                                            <td class='d-flex'><a href='{{route('bank-details.edit', [$data->id])}}' class='btn btn-primary' >Edit</a>
                                                <form action="{{ route('bank-details.destroy', ['bank_detail' => $data->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value={{$data->id}}>
                                                    <button type="submit" class=' ms-3 btn btn-danger' onclick="return confirm('Are you sure want to delete')">Delete</button>
                                                </form></td>

                                                @endif
                                         </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endsection
