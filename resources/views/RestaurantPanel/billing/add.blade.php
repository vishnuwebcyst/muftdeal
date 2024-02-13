@extends('layouts.restaurant')
@section('content')
    <style>
        #myInput {
            background-position: 10px 12px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #myUL {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: none;
            cursor: pointer;
        }

        #myUL li a {
            border: 1px solid #ddd;
            margin-top: -1px;
            /* Prevent double borders */
            background-color: #f6f6f6;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block
        }

        #myUL li a:hover:not(.header) {
            background-color: #eee;
        }

        .custom-dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 5px 5px;
            background-color: #fff;
            z-index: 1000;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .dropdown-menu a:hover {
            background-color: #f0f0f0;
        }

        .custom-dropdown:focus .dropdown-menu {
            display: block;
        }

        #myUL {
            display: none;
            /* Initially hide the #myUL */
        }

        #myInput:focus+#myUL,
        #myUL:hover {
            display: block;
            /* Show #myUL when #myInput is hovered or #myUL is hovered */
        }
    </style>

    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        <aside class="sidenav fixed-start"></aside>
        <main class="main-content position-relative border-radius-lg ">
            <div class="container py-4 mt-5">
                <div class="row">
                    <div class="card px-lg-5 mx-auto">
                        <h4 class='text-center py-4'>Add New Invoice</h4>

                        <div class='mb-3'>

                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."
                                title="Type in a name">

                            <ul id="myUL">
                                @foreach ($products as $type)
                                    <li><a class='product_details' id="{{ 'product-' . $type->id }}"
                                            data-product-id="{{ $type->id }}"
                                            data-small-price="{{ $type->small_price }}"
                                            data-medium-price="{{ $type->medium_price }}"
                                            data-large-price="{{ $type->large_price }}"
                                            data-product-name="{{ $type->item_name }}"
                                            data-product-gst="{{ $type->gst }}">
                                            {{ $type->item_name }}</a></li>
                                @endforeach
                            </ul>

                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Select Variant</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="variantOptions">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="AddProduct" class="btn btn-primary"
                                            data-bs-dismiss="modal">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=''>
                            <form action="{{ route('billing.store') }}" method='post'>
                                @csrf
                                @method('post')
                                <div class='mb-3'>
                                    <label>Customer Name</label>
                                    <input type='text' name='customer_name' class='form-control' required>
                                </div>
                                <div class='mb-3'>
                                    <label>Customer Phone </label>
                                    <input type='text' name='customer_phone' class='form-control' required>
                                </div>
                                <div id="ItemsTable">

                                </div>
                                <div class='float-end'>
                                    <h5>Sub Total : <input type='text' name='grand_total' id="overallTotal"></h5>
                                    <h5>GST Amount : <span id="gst_amount_total"> 0</span></h5>
                                    <h5>CGST : <input name='cgst' id="cgst_persent" readonly></h5>
                                    <h5>SGST : <input name='sgst' id="sgst_persent" readonly></h5>

                                    <div class='mb-3'>
                                        <tr>
                                            <th><b>Discount :</b> </th>
                                            <td> <input type='number' class='mb-3' name='discount' id='discount'
                                                    placeholder="Enter Discount Amount">
                                            </td>
                                        </tr>
                                        <br>
                                        <tr>
                                            <th><b>Enter Changes :</b> </th>
                                            <td> <input type='number' name='extra_charges' id='extra_changes'
                                                    placeholder="Enter Extra Amount">
                                            </td>
                                        </tr>

                                    </div>

                                    <h5>Total : <input type='text' name='total' id="grand_total" readonly></h5>
                                    <button type='submit' class='btn btn-primary mt-3'>Submit</button>
                                </div>
                        </div>
                        <div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </main>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>



        <script>
            function myFunction() {
                var input, filter, ul, li, a, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                ul = document.getElementById("myUL");
                li = ul.getElementsByTagName("li");
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("a")[0];
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }
        </script>
        <script>
            $(document).ready(function() {

                $('.product_details').on('click', function() {
                    var clickedElement = $(this);
                    open_modal(clickedElement);
                });



                function open_modal(clickedElement) {
                    var smallPrice = $(clickedElement).data('small-price');
                    var mediumPrice = $(clickedElement).data('medium-price');
                    var largePrice = $(clickedElement).data('large-price');
                    var productName = $(clickedElement).data('product-name');
                    var productGST = $(clickedElement).data('product-gst');

                    // Your modal logic here
                    // You can use the extracted data in this function
                    $('#exampleModal').modal('show');
                    var variantOptions = $('#variantOptions');
                    variantOptions.html('');

                    // console.log(clickedElement.data('product-name'));

                    var smallPrice = clickedElement.data('small-price');
                    var product_name = clickedElement.data('product-name');
                    var mediumPrice = clickedElement.data('medium-price');
                    var largePrice = clickedElement.data('large-price');

                    $("#AddProduct").data('product-id', clickedElement.data('product-id'));

                    if (smallPrice !== '') {
                        variantOptions.append(createVariantOption('Small', 'small'));
                    }

                    if (mediumPrice !== '') {
                        variantOptions.append(createVariantOption('Medium', 'medium'));
                    }

                    if (largePrice !== '') {
                        variantOptions.append(createVariantOption('Large', 'large'));
                    }


                }


                function createVariantOption(label, value) {
                    var variantOption = $('<div class="form-check">').append(
                        $('<label class="form-check-label">' + label + '</label>'),
                        $('<input class="form-check-input" type="checkbox" id="selectd_va" name="variant" value="' +
                            value + '">')
                    );
                    return variantOption;
                }


                $('#AddProduct').on('click', function() {
                    var productId = $(this).data('product-id');
                    var selectedProductName = $(`#product-${productId}`).data('product-name');
                    var selectedProductGST = $(`#product-${productId}`).data('product-gst');

                    var selectedProductVariants = $('input[name="variant"]:checked').map(function() {
                        return this.value;
                    }).get();

                    for (var i = 0; i < selectedProductVariants.length; i++) {
                        var variantType = selectedProductVariants[i];
                        var selectedVariantPrice;

                        switch (variantType) {
                            case 'small':
                                selectedVariantPrice = $(`#product-${productId}`).data('small-price');
                                break;
                            case 'medium':
                                selectedVariantPrice = $(`#product-${productId}`).data('medium-price');
                                break;
                            case 'large':
                                selectedVariantPrice = $(`#product-${productId}`).data('large-price');
                                break;
                            default:
                                selectedVariantPrice = 0;
                        }

                        $('#ItemsTable').append(`
                        <div class="item-row row border-bottom pt-4 selected-product" data-gst-amount="${(selectedProductGST * selectedVariantPrice) / 100}">
                            <div class='col col-lg-2 mb-3 '>
                                <label for="product_name">Name</label>
                                <p class='product_name'>${selectedProductName}</p>
                                <input type="hidden" name="product_id[]" class='product_id' value="${selectedProductName}">
                            </div>
                            <div class='col col-lg-2 mb-3'>
                                <label for="qty">Qty</label>
                                <input class="form-control w-75 quantity" type='number' name='qty[]' value='1' placeholder="Enter Quantity">
                            </div>
                            <div class='col col-lg-2 mb-3'>
                                <label for="variant_type">Variant Type</label>
                                <p class='variant_type'>${variantType}</p>
                                <input type="hidden" name="variant_type[]" class='variant_type' value="${variantType}">
                            </div>
                            <div class='col col-lg-2 mb-3'>
                                <label for="product_price">Price</label>
                                <p class='product-price'>${selectedVariantPrice}</p>
                                <input type="hidden" name="product_price[]" class='product_price' value="${selectedVariantPrice}">
                            </div>
                            <div class='col col-lg-2 mb-3'>
                                <label for="sub_total">Total</label>
                                <p class='sub-total'>${selectedVariantPrice}</p>
                            </div>
                            <div class='col col-lg-2 mb-3'>
                                <label for="gst">GST (%)</label>
                                <p class='gst'>${selectedProductGST}</p>
                                <input type='hidden' name='gst[]' class='gst_amount' value="${(selectedProductGST * selectedVariantPrice) / 100}">
                                <input type='hidden' name='gst_percent[]' class='gst_amount' value="${selectedProductGST}">
                            </div>
                            <div class="col col-lg-2 mb-3">
                                <a href="#" class="remove-item"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>`);
                        updateTotals();
                        $('.quantity').on('input', function() {
                            var quantity = Number($(this).val()) || 0;
                            var productPrice = Number($(this).closest('.item-row').find(
                                '.product_price').val()) || 0;
                            var discount = Number($(this).closest('.item-row').find('.discount')
                                .text()) || 0;
                            var additionalCharges = Number($('#extra_changes').val()) || 0;
                            var gstAmount = Number($(this).closest('.item-row').find('.gst_amount')
                                .val()) || 0;

                            var total = quantity * productPrice;
                            var totalWithDiscount = total - discount;
                            var finalTotal = totalWithDiscount + gstAmount + additionalCharges;

                            $(this).closest('.item-row').find('.sub-total').text(total);
                            $(this).closest('.item-row').find('.overallTotal').val(totalWithDiscount);
                            $(this).closest('.item-row').find('.grand_total').val(finalTotal);

                            updateTotals();
                        });

                    }
                });


            });

            $(document).on('click', '.remove-item', function() {
                $(this).closest('.item-row').remove();
                updateTotals();
            });


            function updateTotals() {
                var total = 0;
                var totalGstAmount = 0;
                // var totalDiscount = 0;
                var originalDiscount = Number($('#discount').val()) || 0;

                $('.item-row').each(function() {
                    var quantity = Number($(this).find('.quantity').val()) || 0;
                    var productPrice = Number($(this).find('.product_price').val()) || 0;
                    var prGstAmount = Number($(this).data('gst-amount')) || 0;

                    // Recalculate discount based on the new quantity
                    // var newDiscount = originalDiscount * quantity;

                    // console.log(newDiscount)

                    var subtotal = quantity * productPrice;
                    total += subtotal;
                    // totalDiscount += originalDiscount;
                    totalGstAmount += prGstAmount * quantity;
                });

                // var totalGstAmount2 = 0;

                // $('.selected-product').each(function() {
                //     // console.log($(this));
                //     totalGstAmount2 += Number($(this).data('gst-amount'));

                // });

                // console.log(totalGstAmount)

                var additionalCharges = Number($('#extra_changes').val()) || 0;
                var priceToShow = totalGstAmount;

                var sgst_persent = priceToShow / 2;
                var cgst_persent = priceToShow / 2;
                var grand_total = total + priceToShow - originalDiscount + additionalCharges;
                $('#gst_amount_total').text(priceToShow.toFixed(2));
                $('#sgst_persent').val(sgst_persent.toFixed(2));
                $('#cgst_persent').val(cgst_persent.toFixed(2));
                $('#overallTotal').val(total.toFixed(2));
                $('#discount_total').text(originalDiscount.toFixed(2));
                $('#extra_changes_total').text(additionalCharges.toFixed(2));
                $('#grand_total').val(grand_total.toFixed(2));
            }


            $('#discount').on('input', function() {
                // var discount = Number($(this).val()) || 0;
                // if (discount === 0) {
                    updateTotals();
                // }
                // var total_price = Number($('#grand_total').val()) || 0;
                // var totalGstAmount = Number($('#gst_amount_total').text()) || 0;
                // var extra_changes = Number($('#extra_changes').val()) || 0;

                // var total_with_gst = total_price + extra_changes;
                // console.log(total_with_gst);
                // total_with_gst -= discount;

                // console.log(discount)
                // console.log(total_price);
                // console.log(total_with_gst);
                // console.log(discount);
                // console.log(extra_changes);
                // console.log(totalGstAmount);
                // console.log(total_with_gst - discount);

                // $('#grand_total').val(total_with_gst);
            });

            $('#extra_changes').on('input', function() {
                // var extra_charges = Number($(this).val()) || 0;
                // if (extra_charges === 0) {
                    updateTotals();
                // }
                // var total_price = Number($('#grand_total').val());
                // var totalGstAmount = Number($('#gst_amount_total').text());
                // var discount = $('#discount').val();


                // var total_with_gst = total_price;
                // console.log(total_with_gst, 'Total Price');
                // console.log(discount, 'Discount')
                // console.log(extra_charges, 'Charges')
                // total_with_gst += extra_charges;
                // total_with_gst -= discount;

                // console.log(extra_charges);
                // console.log(total_price);
                // console.log(totalGstAmount);
                // console.log(discount);
                // console.log(total_with_gst);
                // console.log(total_with_gst - discount);

                // $('#grand_total').val(total_with_gst);
            });
        </script>
    @endsection
