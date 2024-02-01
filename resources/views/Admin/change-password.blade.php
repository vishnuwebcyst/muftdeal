@extends('layouts.admin')
@section('content')

    <body class="g-sidenav-show   bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start"></aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container py-4 mt-5">
                <div class="row">
                    <div class="card   px-lg-5 mx-auto">
                        <h4 class='text-center py-4'>Change Password</h4>
                        <form action="{{ route('change-password.update', [$data->id]) }}" class="col-lg-8 col-sm-12 mx-auto"
                            method='post'>
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_admin" value="{{ $data->is_admin }}">

                            <div class="form-group">
                                <label for="example-url-input" class="form-control-label">Old Password</label>
                                <input class="form-control" type="password" name="old_password">
                                @if ($errors->has('old_password'))
                                    <small class="text-danger">{{ $errors->first('old_password') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="example-url-input" class="form-control-label">New Password</label>
                                <input class="form-control" type="password" name="password">
                                @if ($errors->has('password'))
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                            <button type="submit" class='btn btn-primary'>Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </main>
    @endsection
