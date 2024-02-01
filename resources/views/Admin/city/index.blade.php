@extends('layouts.admin')
@section('content')
    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start"> </aside>
        <main class="main-content position-relative border-radius-lg">
            <div class="container-fluid py-4">
                <div class=" ">
                    <div class="card  px-2 p-md-5 mx-auto">
                        <div class="row">
                            <div class="col-lg-6 text-center p-2 p-md-0 text-md-end">

                                <h4>All Citys</h4>
                            </div>
                            <div class="col-lg-6 text-center p-2 p-md-0 text-md-end">

                                <a href="{{ route('all-city.create') }}" class=" text-end btn btn-primary shadow-lg"> Add city</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center mb-0 ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>City Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($citys as $key => $city)
                                        <div class="modal fade"id="myModal{{ $city->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalSignTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <div class="card card-plain">
                                                            <div class="card-header text-center">
                                                                <h4>Edit City</h4>
                                                            </div>
                                                            <div class="card-body pb-3">
                                                                 <form role="form text-left"
                                                                    action="{{ route('all-city.update', [$city->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="city_id"
                                                                        value="{{ $city->id }}">
                                                                    <label>City Name</label>
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" name="city_name"
                                                                            class="form-control"
                                                                            value="{{ $city->city_name }}">
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Update</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $city->city_name }}</td>
                                            <td>
                                                <div class="d-flex"> <a class=" mx-2 btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#myModal{{ $city->id }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    <form action="{{ route('all-city.destroy', [$city->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure want to delete  ')"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $citys->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @endsection
