@extends('layouts.restaurant')
@section('content')

    <body class="g-sidenav-show   bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start"></aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container py-4 mt-5">
                <div class="row">
                    <div class="card  px-5 mx-auto">
                        <h4 class='text-center py-4'>Add Background</h4>
                        <form action="{{ route('restaurant.background_post') }}" class="col-lg-8 mx-auto" method='post'
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="example-url-input" class="form-control-label">Background Image</label>
                                <input class="form-control" type="file" name="image">
                                @if ($errors->has('image'))
                                    <small class="text-danger">{{ $errors->first('image') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="example-url-input" class="form-control-label">Font Color</label>
                                <input class="form-control" type="text" name="color">
                                @if ($errors->has('color'))
                                    <small class="text-danger">{{ $errors->first('color') }}</small>
                                @endif
                            </div>


                            <button type="submit" class='btn btn-primary'>Add</button>

                        </form>
                    </div>

                </div>
            </div>
        </main>
    @endsection
