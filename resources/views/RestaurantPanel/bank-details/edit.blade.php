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

                            <h4 class='text-center py-4'>Edit Upi Id</h4>
                            <div class=" col-lg-8 col-12 mx-auto">
                                <form action="{{ route('bank-details.update', ['bank_detail' => $data->id]) }}" method='post' class="px-3">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="id">UPI Id</label>
                                        <input class="form-control" type="text" name="upi_id"
                                            placeholder="Enter upi id" value="{{ $data->upi_id }}" >
                                        <input type="hidden" name="id"  value="{{ $data->id }}" >
                                        @if ($errors->has('upi_id'))
                                            <small class="text-danger">{{ $errors->first('upi_id') }}</small>
                                        @endif
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
