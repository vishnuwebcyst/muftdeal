@extends('layouts.admin')
@section('content')  <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start"> </aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container py-4">
                <div class="row">
                    <div class="">
                        <div class="card  px-5">
                            <h4 class='text-center  py-4'>Add New Restaurant</h4>
                            <form action="{{ route('restaurant.store') }}" method='post' class=" col-lg-8 mx-auto"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">City Name</label>
                                    {{-- <input class="form-control" type="text" name="city_name" --}}
                                    <select class="form-select    rouded-circle shadow-none" name="city_name"
                                        aria-label="Default select example">
                                        <option disabled selected>Select City</option>
                                        @foreach ($citys as $city)
                                            <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('city_name'))
                                        <small class="text-danger">{{ $errors->first('city_name') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="example-search-input" class="form-control-label">Restaurant Name</label>
                                    <input class="form-control" type="text" name="restaurant_name" value="{{ old('restaurant_name') }}" placeholder="Enter Restaurant Name">
                                    @if ($errors->has('restaurant_name'))
                                        <small class="text-danger">{{ $errors->first('restaurant_name') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="example-email-input" class="form-control-label">Restaurant Logo</label>
                                    <input class="form-control" type="file" name="image" value="{{ old('image') }}">
                                    @if ($errors->has('image'))
                                        <small class="text-danger">{{ $errors->first('image') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="example-email-input" class="form-control-label">Restaurant Thumbnail</label>
                                    <input class="form-control" type="file" name="main_image" value="{{ old('main_image') }}">
                                    @if ($errors->has('main_image'))
                                        <small class="text-danger">{{ $errors->first('main_image') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="example-email-input" class="form-control-label">Location</label>
                                    <input class="form-control" type="text" name="location"
                                        value="{{ old('location') }}"  placeholder="Enter Location">
                                    @if ($errors->has('location'))
                                        <small class="text-danger">{{ $errors->first('location') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="example-url-input" class="form-control-label">Phone Number</label>
                                    <input class="form-control" type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone Number">
                                    @if ($errors->has('phone'))
                                        <small class="text-danger">{{ $errors->first('phone') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="example-url-input" class="form-control-label">Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="Enter Password" value="{{ old('Password') }}">
                                    @if ($errors->has('password'))
                                        <small class="text-danger">{{ $errors->first('password') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="example-url-input" class="form-control-label">Open Time</label>


                                    <input class="form-control" type="time" name="open_time">
                                    {{-- <input type="text" id="maxTime" class="form-control options-control" name="open_time" placeholder="HH:mm" pattern="(([01][0-9]|2[0-3]):[0-5][0-9])?" maxlength="5" data-format="HH:mm" /> --}}


                                    <div class="row">


                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="example-url-input" class="form-control-label">Close Time</label>
                                    <input class="form-control" type="time" name="close_time">

                                    {{-- <input type="text" id="maxTime" class="form-control options-control" name="close_time" placeholder="HH:mm" pattern="(([01][0-9]|2[0-3]):[0-5][0-9])?" maxlength="5" data-format="HH:mm" /> --}}
                                </div>
                                <div class="form-group">
                                    <label for="example-url-input" class="form-control-label">URL</label>
                                    <input class="form-control" type="text" name="url" value="{{ old('url') }}" placeholder="Enter Url">
                                    @if ($errors->has('url'))
                                        <small class="text-danger">{{ $errors->first('url') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Restaurant Type</label>
                                    <select class="form-select rouded-circle shadow-none" name="restaurant_type"
                                        aria-label="Default select example">
                                        <option disabled selected>Select Restaurant type</option>

                                        <option value="veg">Veg</option>
                                        <option value="non-veg">Non-Veg</option>
                                        <option value="veg and non-veg">Veg and non-veg</option>

                                    </select>

                                    @if ($errors->has('restaurant_type'))
                                        <small class="text-danger">{{ $errors->first('restaurant_type') }}</small>
                                    @endif
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='description' class='form-control-label'>Enter Description</label>
                                    <textarea name="description" id='description' class='form-control' placeholder="Enter Description"></textarea>
                                    @if ($errors->has('description'))
                                            <small class="text-danger">{{ $errors->first('description') }}</small>
                                        @endif
                                </div>
                                <button type="submit" class='btn btn-primary'>Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endsection
