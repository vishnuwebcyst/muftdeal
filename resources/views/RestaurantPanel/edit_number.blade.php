@extends('layouts.restaurant')
@section('content')

    <body class="g-sidenav-show   bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start"></aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container py-4 my-5">
                <div class="row">
                    <div class="">
                        <div class="card">

                            <h4 class='text-center py-4'>Menu Number</h4>
                            <div class=" col-lg-8 col-12 mx-auto">
                                <form action="{{ route('restaurant.post_menu_phone', [auth()->guard('restaurant')->user()->id]) }}" method='post' class="px-3">
                                    @csrf
                                    <div class="mb-3">

                                        <label for="number">Menu number</label>
                                        <input class="form-control" type="number" name="menu_number" value="{{ $data->menu_number}}" placeholder="Enter phone number">

                                    </div>
                                    <button type="submit" class='btn btn-primary'>Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endsection
