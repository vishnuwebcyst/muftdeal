@extends('layouts.admin')

@section('content')
 <body class="g-sidenav-show   bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start"> </aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container py-4 mt-5">
                <div class="row">
                    <div class="card  px-5 mx-auto  ">
                        <h4 class='text-center py-4'>Update Restaurant</h4>
                        <form action="{{ route('restaurant.update', ['restaurant' => $data->id]) }}" class="col-lg-8 mx-auto"
                            method='post' enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">City Name</label>
                                {{-- <input class="form-control" type="text" name="city_name" value="{{ $data->city_name }}"> --}}
                                <select class="form-select rouded-circle shadow-none" name="city_name">
                                    <option disabled >Select City</option>
                                    @foreach ($citys as $city)
                                        <option value="{{ $city->city_name }}" @if ($city->city_name == $data->city_name) selected @endif>{{ $city->city_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-search-input" class="form-control-label">Restaurant Name</label>
                                <input class="form-control" type="text" name="restaurant_name"
                                    value="{{ $data->restaurant_name }}">
                                    @if ($errors->has('restaurant_name'))
                                        <small class="text-danger">{{ $errors->first('restaurant_name') }}</small>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="example-email-input" class="form-control-label">Restaurant Logo</label>
                                <input class="form-control" type="file" name="image" value="{{ $data->image }}">
                                <img src="{{ asset('uploads/images/' . $data->image) }}" class="py-2"  width="200" alt="Restaurant Image">
                                @if ($errors->has('image'))
                                <small class="text-danger">{{ $errors->first('image') }}</small>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for="example-email-input" class="form-control-label">Restaurant Thumbnail</label>
                                <input class="form-control" type="file" name="main_image" value="{{ $data->main_image }}">
                                @if(!empty($data->thumbnail))
                                <img src="{{ asset('uploads/images/' . $data->thumbnail) }}" class="py-2"   width="200" alt="Restaurant Image">
                                @endif
                                @if ($errors->has('main_image'))
                                <small class="text-danger">{{ $errors->first('main_image') }}</small>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for="example-email-input" class="form-control-label">Location</label>
                                <input class="form-control" type="text" name="location" value="{{ $data->location }}">
                                @if ($errors->has('location'))
                                        <small class="text-danger">{{ $errors->first('location') }}</small>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="example-url-input" class="form-control-label">Phone Number</label>
                                <input class="form-control" type="text" name="phone" value="{{ $data->phone }}">
                                @if ($errors->has('phone'))
                                        <small class="text-danger">{{ $errors->first('phone') }}</small>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="example-url-input" class="form-control-label">Password</label>
                                <input class="form-control" type="password" name="password" value="{{ $data->password }}">
                                @if ($errors->has('password'))
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for="example-url-input" class="form-control-label">URL</label>
                                <input class="form-control" type="text" name="url" value="{{ $data->url }}">
                                @if ($errors->has('url'))
                                <small class="text-danger">{{ $errors->first('url') }}</small>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for="example-url-input" class="form-control-label">Open Time</label>
                                <input class="form-control" type="time" name="open_time" value="{{ $data->open_time }}" placeholder="Enter opening time">
                                {{-- <input type="text" id="maxTime" class="form-control options-control" value="{{ $data->open_time }}" name="open_time" placeholder="HH:mm" pattern="(([01][0-9]|2[0-3]):[0-5][0-9])?" maxlength="5" data-format="HH:mm" /> --}}

                                @if ($errors->has('open_time'))
                                <small class="text-danger">{{ $errors->first('open_time') }}</small>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for="example-url-input" class="form-control-label">Close Time</label>
                                <input class="form-control" type="time" name="close_time" value="{{ $data->close_time }}" placeholder="Enter closing time">
                                {{-- <input type="text" id="maxTime" class="form-control options-control" value="{{ $data->close_time }}" name="close_time" placeholder="HH:mm" pattern="(([01][0-9]|2[0-3]):[0-5][0-9])?" maxlength="5" data-format="HH:mm" /> --}}

                                @if ($errors->has('close_time'))
                                <small class="text-danger">{{ $errors->first('close_time') }}</small>
                            @endif
                            </div>
                            {{-- <div class="form-group">
                                <div class="row">
                                    <label for="example-url-input" class="form-control-label">Open Time</label>

                                    <div class="col-8">
                                        <input class="form-control" type="text" name="open_time" value="{{ $data->open_time }}">

                                    </div>
                                    <div class="col-4">
                                        <select class="form-select rouded-circle shadow-none" name="open_time_format">
                                            <option disabled selected>Select AM or PM</option>
                                            <option value="pm">am</option>
                                            <option value="am">pm</option>

                                        </select>
                                    </div>
                                    @if ($errors->has('open_time'))
                                <small class="text-danger">{{ $errors->first('open_time') }}</small>
                            @endif
                                </div>

                            </div>
                            <div class="form-group">

                                <div class="row">
                                    <label for="example-url-input" class="form-control-label">Close Time</label>

                                    <div class="col-8">
                                        <input class="form-control" type="time" name="close_time" value="{{ $data->close_time }}">
                                    </div>
                                    <div class="col-4">
                                        <select class="form-select rouded-circle shadow-none" name="close_time_format">
                                            <option disabled selected>Select AM or PM</option>
                                            <option value="pm">am</option>
                                            <option value="am">pm</option>

                                        </select>
                                    </div>
                                    @if ($errors->has('close_time'))
                                <small class="text-danger">{{ $errors->first('close_time') }}</small>
                            @endif
                                </div>
                            </div> --}}
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
                                <textarea name="description" id='description' class='form-control' > {{ $data->description }}</textarea>
                                @if ($errors->has('description'))
                                        <small class="text-danger">{{ $errors->first('description') }}</small>
                                    @endif
                            </div>
                            <button type="submit" class='btn btn-success'>Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>

    @endsection
