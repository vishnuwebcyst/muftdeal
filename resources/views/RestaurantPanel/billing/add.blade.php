@extends('layouts.restaurant')
@section('content')
    <style>
        .table tbody tr:last-child td {
            border-width: 0.4px !important;
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
                        <form action ='{{ route('billing.store') }}' method='post'>
                            @csrf()
                            <div class='table-responsive'>
                                <table class="table table-bordered w-50">
                                    <tbody>
                                        <tr>
                                            <div><b>Bill To</b></div>
                                            <div class='my-3 col-md-3 col-12'>
                                                <label for="customer_name">Enter Customer Name</label>
                                                <input type='text' name='customer_name' class='form-control'
                                                    placeholder="Enter Customer Name" required>

                                            </div>
                                            @if ($errors->has('customer_name'))
                                                <small class="text-danger">{{ $errors->first('customer_name') }}</small>
                                            @endif
                                            <div class='mb-3 col-md-3 col-12'>
                                                <label for="phone">Enter Customer Phone Number</label>
                                                <input type='text' name='customer_phone' class='form-control'
                                                    placeholder='Enter Phone Number' required>
                                            </div>
                                            @if ($errors->has('customer_phone'))
                                                <small class="text-danger">{{ $errors->first('customer_phone') }}</small>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                                <div class='table-responsive'>
                                    <table class="table table-condensed table-bordered items-table">
                                        <thead>
                                            <tr>
                                                <th>Product name </th>
                                                <th>Select Variant</th>
                                                <th>Quantity</th>
                                                <th>Product Price</th>
                                                <th>Amount</th>
                                                <th width="20">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot id="TotalsSection">
                                            <tr>
                                                <td class="wide-cell" colspan="3"><button type="button" id="AddProduct"
                                                        class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> </button>
                                                </td>
                                                <td><strong>Subtotal</strong>
                                                </td>
                                                <td colspan="2">
                                                    <input type="text" id='sub_total_price' name='sub_total'
                                                        class='form-control' readonly>

                                                </td>
                                            </tr>
                                            {{-- <tr>
                                                <td class="wide-cell" colspan="3"></td>
                                                <td><strong>GST (%)</strong>
                                                </td>
                                                <td colspan="2">
                                                    <input type="number" id="gst" name="gst" step="0.01"
                                                        class="form-control" placeholder="Enter GST (%)" min='0'>
                                                    </span>
                                                </td>
                                            </tr> --}}
                                            <tr>
                                                <td class="wide-cell" colspan="3"></td>
                                                <td><strong>GST (%)</strong>
                                                </td>
                                                <td colspan="2">
                                                    <input type="number" id="gst" name="gst" step="0.01"
                                                        class="form-control" placeholder="Enter CGST (%)" min='0'>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="wide-cell" colspan="3"></td>
                                                <td><strong>SGST (%)</strong>
                                                </td>
                                                <td colspan="2">
                                                    <input type="number" id="sgst" name="sgst" step="0.01"
                                                        class="form-control" placeholder="Enter SGST (%)" min='0' readonly>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="wide-cell" colspan="3"></td>
                                                <td><strong>CGST (%)</strong>
                                                </td>
                                                <td colspan="2">
                                                    <input type="number" id="cgst" name="cgst" step="0.01"
                                                        class="form-control" placeholder="Enter SGST (%)" min='0' readonly>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="wide-cell" colspan="3"></td>
                                                <td><strong>Discount Amount</strong>
                                                </td>
                                                <td colspan="2"><input type="number" name='discount' id="discount"
                                                        class="form-control" placeholder="Enter Discount"
                                                        min='0'></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="wide-cell" colspan="3"></td>
                                                <td><strong>Total</strong>
                                                </td>
                                                <td colspan="2">
                                                    <input type="number" id="total" name="total" class="form-control"
                                                        readonly>
                                                </td>

                                            </tr>



                                        </tfoot>

                                        <tbody id="ItemsTable">
                                            <tr class="item-row">
                                                <td>
                                                    <select class="form-select shadow-none product-select"
                                                        name="product_id[]" aria-label="Default select example" required>
                                                        <option disabled selected required>Select Product</option>
                                                        @foreach ($products as $type)
                                                            <option value="{{ $type->item_name }}"
                                                                data-small-price="{{ $type->small_price }}"
                                                                data-medium-price="{{ $type->medium_price }}"
                                                                data-large-price="{{ $type->large_price }}">
                                                                {{ $type->item_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('product_id'))
                                                        <small
                                                            class="text-danger">{{ $errors->first('product_id') }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <select class="form-select shadow-none variant-select"
                                                        name="variant_type[]" aria-label="Default select example" required>
                                                        <option disabled selected>Select Variant</option>
                                                        <option value="small_price">Small Price</option>
                                                        <option value="medium_price">Medium Price</option>
                                                        <option value="large_price">Large Price</option>

                                                    </select>
                                                    @if ($errors->has('variant_type'))
                                                        <small
                                                            class="text-danger">{{ $errors->first('variant_type') }}</small>
                                                    @endif
                                                </td>
                                                <td><input data-key="qty" class="form-control" type='number' name='qty[]'
                                                        placeholder="Enter Quantity">
                                                    @if ($errors->has('qty'))
                                                        <small class="text-danger">{{ $errors->first('qty') }}</small>
                                                    @endif
                                                </td>
                                                <td><input data-key="unit_price" type='number' name='product_price[]' class="form-control unit-price" placeholder="Product Amount"
                                                        readonly></td>
                                                <td data-key="subtotal"><input type="text" name='total_price[]' class="form-control subtotal-input" placeholder="Total Amount"
                                                        readonly></td>
                                                <td><a href="#" class="btn btn-danger btn-sm remove-item"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type='submit' class='btn btn-primary'>Submit</button>
                        </form>

                    </div>
                </div>
            </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

        <script>
            $(document).ready(function() {
                updateRemoveButtonState();
                $('#AddProduct').on('click', function() {
                    var newRow = $('#ItemsTable tr:first').clone();
                    $('#ItemsTable').append(newRow);

                    newRow.find('.remove-item').prop('disabled', false);

                    updateRemoveButtonState();
                });
                $(document).on('click', '.remove-item', function() {

                    $(this).closest('tr').remove();

                    updateRemoveButtonState();
                });

                $(document).on('change', '#ItemsTable input[data-key="qty"], #ItemsTable input[data-key="unit_price"]',
                    function() {

                        updateSubtotal($(this).closest('tr'));
                    });

                function updateRemoveButtonState() {
                    var rowCount = $('#ItemsTable tr').length;

                    if (rowCount === 1) {
                        $('#ItemsTable tr:first .remove-item').prop('disabled', true);
                    }
                }

                function updateSubtotal(row) {
                    var qty = parseFloat(row.find('input[data-key="qty"]').val()) || 0;
                    var unitPrice = parseFloat(row.find('input[data-key="unit_price"]').val()) || 0;

                    var subtotal = qty * unitPrice;

                    row.find('td[data-key="subtotal"] input.subtotal-input').val(subtotal.toFixed(2));

                    updateTotal();
                }

                function updateTotal() {
                    var total = 0;
                    $('.item-row').each(function() {
                        var subtotal = parseFloat($(this).find('td[data-key="subtotal"] input.subtotal-input')
                            .val()) || 0;

                        total += subtotal;
                    });



                    $('#sub_total_price').val(total.toFixed(2));



                    var gst = parseFloat($('#gst').val()) || 0;

                    total += (total * gst) / 100;
                    var discount = parseFloat($('#discount').val()) || 0;
                    total -= discount;

                    var sgst = gst / 2;
                    var cgst = gst / 2;

                    $('#total').val(total.toFixed(2));
                    $('#sgst').val(sgst.toFixed(2));
                    $('#cgst').val(sgst.toFixed(2));
                }

                $('.item-row input[data-key="qty"], .item-row input[data-key="unit_price"]').on('input', function() {
                    var row = $(this).closest('tr');
                    updateSubtotal(row);
                });

                $('#discount, #gst').on('input', function() {
                    updateTotal();
                });

                updateTotal();
            });

            $(document).ready(function() {
                $('#ItemsTable').on('change', '.product-select, .variant-select', function() {

                    var row = $(this).closest('.item-row');
                    var foodId = row.find('.product-select').val();
                    var productPrice = row.find('.variant-select').val();
                    var selectedOption = row.find('.product-select').find(':selected');

                    var unitPrice;
                    switch (productPrice) {
                        case 'small_price':
                            unitPrice = selectedOption.data('small-price');
                            break;
                        case 'medium_price':
                            unitPrice = selectedOption.data('medium-price');
                            break;
                        case 'large_price':
                            unitPrice = selectedOption.data('large-price');
                            break;
                        default:
                            unitPrice = 0;
                    }
                    row.find('.unit-price').val(unitPrice);
                });
            });
        </script>
    @endsection
