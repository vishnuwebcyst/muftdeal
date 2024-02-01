@extends('layouts.admin')
@section('content')

    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav   fixed-start"> </aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="card-group">

                        <div class="card m-3">
                            <a href="{{ route('restaurant.index') }}">
                                <div class="card-body pt-4">
                                    <p class="card-title h5 d-block text-darker"> Total Restaurant </p>
                                    <div class="author align-items-center">
                                        <div class="ps-3"> <span>{{ $total_restaurant }}</span> </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card m-3">
                            <a href="{{ route('restaurant.pending') }}">
                                <div class="card-body pt-4">
                                    <p class="card-title h5 d-block text-darker"> Pending Restaurant </p>
                                    <div class="author align-items-center">
                                        <div class="ps-3">
                                            <span>{{ $pending_restaurant }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card m-3">
                            <a href="#">
                                <div class="card-body pt-4">
                                    <p class="card-title h5 d-block text-darker"> Today Register Restaurant </p>
                                    <div class="author align-items-center">
                                        <div class="ps-3">
                                            <span>{{ $today_register }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </div>
    @endsection
