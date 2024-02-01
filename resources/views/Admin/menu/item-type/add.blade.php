@extends('layouts.admin')
@section('content')

    <body class="g-sidenav-show   bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start"></aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container py-4 my-5">
                <div class="row">
                    <div class="">
                        <div class="card">

                            <h4 class='text-center py-4'>Add Menu Type</h4>
                            <div class=" col-lg-8 col-12 mx-auto">
                                <form action="{{ route('item-type.store') }}" method='post' class="px-3">
                                    @csrf
                                    <input class="form-control" type="hidden" name="restaurant_id"
                                        value={{ $restaurant_id }}>


                                    <div class="form-group">
                                        <label for="example-search-input" class="form-control-label">Menu Type</label>
                                        <input class="form-control" type="text" name="title[]" placeholder="Enter Menu Type">
                                    </div>
                                    {{-- <div class="form-group">
                            <label for="example-search-input" class="form-control-label">Medium Title</label>
                            <input class="form-control" type="text" name="title[]">
                        </div>
                        <div class="form-group">
                            <label for="example-search-input" class="form-control-label">Large Title</label>
                            <input class="form-control" type="text" name="title[]">
                        </div> --}}
                                    <button type="submit" class='btn btn-primary'>Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endsection
