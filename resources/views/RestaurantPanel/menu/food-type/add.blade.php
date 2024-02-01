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

                            <h4 class='text-center py-4'>Add category Type</h4>
                            <div class=" col-lg-8 col-12 mx-auto">
                                <form action="{{ route('food-types.store') }}" method='post' class="px-3">
                                    @csrf
                                    <input class="form-control" type="hidden" name="restaurant_id" value={{ $restaurant_id }}>
                                    <div class="form-group">
                                        <label for="example-search-input" class="form-control-label">Category name</label>
                                        <input class="form-control" type="text" name="food_type" placeholder="Enter Menu Type" required>
                                    </div>

<div id='menu_type'>
    <div class="form-group">
        <label for="example-search-input" class="form-control-label">Food Type</label>
        <input class="form-control" type="text" name="item_type[]" required placeholder="Enter Food Type">
    </div>

</div>
<div>

<button id="cloneBtn" type='button' class='btn btn-success'>+ </button>
<button id="removeBtn" type='button' class='btn btn-danger'>-</button>
</div>
                                    {{-- <div class="form-group">
                                        <label for="example-search-input" class="form-control-label">Food Type</label>
                                        <input class="form-control" type="text" name="item_type[]" required  placeholder="Enter Food Type">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-search-input" class="form-control-label">Food Type</label>
                                        <input class="form-control" type="text" name="item_type[]"  placeholder="Enter Food Type">
                                    </div>


                                    <div class="form-group">
                                        <label for="example-search-input" class="form-control-label">Food Type</label>
                                        <input class="form-control" type="text" name="item_type[]"  placeholder="Enter Food Type">
                                    </div> --}}
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
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
            $("#cloneBtn").on("click", function() {
                var menuTypesCount = $("#menu_type .form-group").length;
                if(menuTypesCount > 2) {
                    alert("You can't add more than two menu types.");

                }else{

                    var clone = $("#menu_type .form-group:first").clone();
                    $("#menu_type").append(clone);
                }
            });

             $("#removeBtn").on("click", function() {
                var menuTypesCount = $("#menu_type .form-group").length;

                if (menuTypesCount > 1) {
                    $("#menu_type .form-group:last").remove();
                } else {
                    alert("At least one menu type is required.");
                }

            });
        </script>
    @endsection
