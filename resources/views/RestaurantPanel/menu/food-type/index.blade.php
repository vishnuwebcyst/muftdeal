@extends('layouts.restaurant')

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
                        <div class="card-header d-flex justify-content-end">
                            <a href="{{ route('food-types.create', ['restaurant_id' => request('restaurant_id')]) }}"
                                class="btn btn-primary ms-3">Add new category</a>

                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0 ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Menu Type</th>
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
                                            <td>{{ $restaurant->food_type }}</td>
                                            <td>
                                                <div class='d-flex'>
                                                    <a data-bs-toggle="modal" data-bs-target="#myModal{{ $restaurant->id }}"
                                                        class=''><i class="fas fa-edit"></i></a>

                                                    <form action="{{ route('food-types.destroy', [$restaurant->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class='border-0 bg-transparent'
                                                            onclick="return confirm('Are you sure want to delete')"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#change_position{{ $restaurant->id }}"
                                                        class='btn btn-primary'>Move Up</a>


                                                </div>
                                                <div class="modal fade"id="change_position{{ $restaurant->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body p-0">
                                                                <div class="card card-plain">
                                                                    <div class="card-header text-center">
                                                                        <h4>Change Menu Position</h4>
                                                                    </div>
                                                                    <div class="card-body pb-3">

                                                                        <form
                                                                            action="{{ route('food-types.change_categories', [$restaurant->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('post')
                                                                            <label for="position">Enter Postion</label>
                                                                            <div class="mb-3">
                                                                                <input type="number" name="position"
                                                                                    class="form-control" id="position"
                                                                                    value="{{ $restaurant->position }}">
                                                                                <input type="hidden" name="menu_id"
                                                                                    value="{{ $restaurant->id }}">
                                                                                <input type="hidden" name="restaurant_id"
                                                                                    value="{{ $restaurant->restaurant_id }}">
                                                                            </div>
                                                                            <button type="submit"
                                                                                class='border-0 btn btn-primary'>Move
                                                                                Up</button>
                                                                        </form>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal fade"id="myModal{{ $restaurant->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalSignTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body p-0">
                                                                <div class="card card-plain">
                                                                    <div class="card-header text-center">
                                                                        <h4>Edit Menu Type</h4>
                                                                    </div>
                                                                    <div class="card-body pb-3">


                                                                        <form role="form text-left"
                                                                            action="{{ route('food-types.update', ['food_type' => $restaurant->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')

                                                                            <input type="hidden" name="restaurant_id"
                                                                                value="{{ $restaurant->restaurant_id }}">
                                                                            <input type="hidden" name="menu_id"
                                                                                value="{{ $restaurant->id }}">

                                                                            <div>
                                                                                <label>Type Name</label>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" name="food_type"
                                                                                        class="form-control"
                                                                                        value="{{ $restaurant->food_type }}">
                                                                                </div>
                                                                                @if ($errors->has('food_type'))
                                                                                    <small
                                                                                        class="text-danger">{{ $errors->first('food_type') }}</small>
                                                                                @endif
                                                                                @foreach (json_decode($restaurant->item_type) as $itemType)
                                                                                <label>Item Type</label>
                                                                                    <input type="text" name="item_type[]" class="form-control" value="{{ $itemType }}">
                                                                                @endforeach
                                                                            </div>


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
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @endsection
