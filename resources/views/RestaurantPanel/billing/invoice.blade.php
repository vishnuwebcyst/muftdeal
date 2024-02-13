<html>

<head>
    <title>Muft Deal</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>


<style>
    body {
        width: 100% !important;
        padding: 3px;
    }

    .border-top {
        border-top: 1px solid black !important;
    }


    * {
        border: 0;
        box-sizing: content-box;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
        font-style: inherit;
        font-weight: inherit;
        line-height: inherit;
        list-style: none;
        margin: 0;
        padding: 0;
        text-decoration: none;
        vertical-align: top;
        object-fit: cover;
    }


    h2 {
        font: bold 100% sans-serif;
        letter-spacing: 0.1em;
        text-align: center;
        text-transform: uppercase;
        background-color: #FFF;
        font-size: 24px !important;
    }

    h6 {
        font: bold 100% sans-serif;
        text-align: center;
        font-size: 13px !important;

    }

    table {
        font-size: 100%;
        width: 100%;
    }



    th {
        font-weight: bold;
        position: relative;
        text-align: left;
        font-size: 19px;

    }

    td {
        position: relative;
        text-align: left;
        font-size: 22px;

    }


    thead tr {
        border-top: 2px solid black !important;
        border-bottom: 2px solid black !important;
    }

    .margin {
        padding-bottom: 35px !important;
    }

    .padding-1 {
        padding: left 12px, i !important;
    }

    body {
        box-sizing: border-box;
        margin: 0 auto;
        background: #FFF;
        border-radius: 1px;
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    }

    header:after {
        clear: both;
        content: "";
        display: table;
    }

    header h1 {
        background: #000;
        border-radius: 0.25em;
        color: #FFF;
        margin: 0 0 1em;
        padding: 0.5em 0;
    }

    header address {
        float: left;
        font-size: 75%;
        font-style: normal;
        margin: 0 1em 1em 0;
    }

    header address p {
        margin: 0 0 0.25em;
    }

    header span,
    header img {
        display: block;
        float: right;
    }

    header span {
        margin: 0 0 1em 1em;
        max-height: 25%;
        max-width: 60%;
        position: relative;
    }

    header img {
        max-height: 100%;
        max-width: 100%;
    }

    header input {
        cursor: pointer;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        height: 100%;
        left: 0;
        opacity: 0;
        position: absolute;
        top: 0;
        width: 100%;
    }


    article,
    article address,
    table.meta,
    table.inventory {
        margin: 0 0 3em;
    }

    article:after {
        clear: both;
        content: "";
        display: table;
    }

    article h1 {
        clip: rect(0 0 0 0);
        position: absolute;
    }

    article address {
        float: left;
        font-size: 125%;
        font-weight: bold;
    }


    table.meta,
    table.balance {
        float: right;
        width: 70%;

    }

    table.meta:after,
    table.balance:after {
        clear: both;
        content: "";

    }
    @media print {
  .print_btn{
    display:none;
  }}
</style>
</head>

<body style='width:400px;margin:auto'>
    <button class='print_btn btn btn-primary' onclick='window.print()'>Print Now</button>
    <header class="mt-3">
        <h4 class='text-center mb-1'>Tax Invoice</h4>
        <h2 class='text-center m-0 text-uppercase'><em>{{ $restaurant->restaurant_name }}</em></h2>
        <h4 class='text-center m-0'>{{ $restaurant->location }}</h4>
        <h4 class='text-center m-0'>{{ $restaurant->phone }}</h4>
        <address>

            {{-- <h2>{{ $data['customer_name'] }}</h2>

            <h2>{{ $data['customer_phone'] }}</h2> --}}
        </address>
    </header>
    <article>
        <table class="meta">
            <tr>
                <th> Invoice No : </th>


                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td> {{ $product_id->invoice_number }}</td>
                    @endif
                @endforeach

            </tr>
            <tr>
                <th> Date :</th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td>{{ $product_id->created_at->format('Y-m-d  ') }}</td>
                    @endif
                @endforeach

            </tr>

        </table>
        <br><br><br><br>
        <table class="inventory p-2">
            <thead>
                <tr>
                    <th width='100'>Products</th>
                    <th width='55'>Qty</th>
                    <th width='70'>Rate</th>
                    <th width='80'>GST(%)</th>
                    <th width='85'>Amount</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $key => $product_id)
                    <tr>
                        <td class='d-flex'> {{ $product_id->product_id }} </td>
                        <td>{{ $product_id->quantity }} </td>
                        <td>{{ $product_id->unit_price }} </td>
                        <td>{{ $product_id->product_gst }} </td>
                        <td>{{ $product_id->sub_total * $product_id->quantity }} </td>


                    </tr>
                @endforeach
                <tr>


                </tr>


            </tbody>
        </table>
        <table class="balance text-end">


            <tr class="border-top  border-dark ">
                <th width='55' class="text-end"> Sub total : </th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td class="text-end pe-5 "> {{ $product_id->grand_total   }}</td>
                    @endif
                @endforeach
            </tr>

            <tr>
                <th width='50' class="text-end"> CGST : </th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td class="text-end pe-5"> {{ $product_id->cgst  }}</td>
                        {{-- <td class="text-end pe-5 "> {{ round(($product_id->cgst * $product_id->grand_total) / 100) }}</td> --}}
                    @endif
                @endforeach
            </tr>
            <tr>
                <th width='50' class="text-end "> SGST : </th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                    @php

                        $sgst = $product_id->sgst;
                        $cgst = $product_id->cgst;
                    @endphp
                        {{-- <td> {{ $product_id->sgst  }}</td> --}}
                        <td class="text-end pe-5 "> {{ $sgst }}</td>
                    @endif
                @endforeach
            </tr>
            <tr class="border-top">
                <th class="text-end  "> Total : </th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td class="text-end pe-5 "> {{ $product_id->grand_total + $cgst + $sgst  }}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th class="text-end"> Discount: </th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td class="text-end pe-5 "> {{ $product_id->discount }}</td>
                    @endif
                @endforeach
            </tr>
            <tr class='  '>
                <th  class=" text-end"> Charges : </th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td class="text-end pe-5  "> {{ $product_id->extra_charges }}</td>
                    @endif
                @endforeach
            </tr>
            <tr class='border-top'>
                <th   class=" text-end" style='width:200px;'>  Grand Total :  </th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                    @php
$sub_total = $product_id->total  + $product_id->extra_charges
                    @endphp
                        <td class="text-end pe-5  "> {{$product_id->total  }}</td>
                    @endif
                @endforeach
            </tr>

        </table>

    </article>
    @foreach ($data as $key => $product_id)
        @if ($key === 0)
            <h3 class='text-uppercase'> {{ $product_id->customer_name }}</h3>
        @endif
    @endforeach
    @foreach ($data as $key => $product_id)
        @if ($key === 0)
            <h4>Rupees
                {{ ucfirst(\NumberFormatter::create('en_US', \NumberFormatter::SPELLOUT)->format($product_id->total)) }}
                only</h4>
        @endif
    @endforeach
    <h3><b>Thankyou</b></h3>

</body>

</html>
