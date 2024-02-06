<html>

<head>
    <meta charset="utf-8">
    <title>Muft Deal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
    /* reset */
    body {
        width: 600px !important;

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


    h1 {
        font: bold 100% sans-serif;
        letter-spacing: 0.5em;
        text-align: center;
        text-transform: uppercase;
    }

    /* table */

    table {
        font-size: 75%;
        table-layout: fixed;
        width: 100%;
    }

    table {
        border-collapse: separate;
        border-spacing: 2px;
    }

    th,
    td {
        border-width: 1px;
        padding: 0.5em;
        position: relative;
        text-align: left;
    }



    th {
        background: #EEE;
        border-color: #BBB;
        font-weight: bold;
    }

    td {
        border-color: #DDD;
    }

    /* page */


    body {
        box-sizing: border-box;
        height: 11in;
        margin: 0 auto;
        padding: 0.5in;
        width: 8.5in;
    }

    body {
        background: #FFF;
        border-radius: 1px;
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    }

    /* header */


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
        width: 36%;
    }

    table.meta:after,
    table.balance:after {
        clear: both;
        content: "";
        display: table;
    }
</style>
</head>

<body>
    <header>
        <h4 class='text-center m-0'>Tax Invoice</h4>
        <h2 class='text-center m-0 text-uppercase'>{{ $restaurant->restaurant_name }}</h2>
        <p class='text-center m-0'>{{ $restaurant->location }}</p>
        <p class='text-center m-0'>{{ $restaurant->phone }}</p>
        <address>

            {{-- <h2>{{ $data['customer_name'] }}</h2>

            <h2>{{ $data['customer_phone'] }}</h2> --}}
        </address>
    </header>
    <article>
        <table class="meta">
            <tr>
                <th> Invoice No </th>


                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td> {{ $product_id->invoice_number }}</td>
                    @endif
                @endforeach

            </tr>
            <tr>
                <th> Date </th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td>{{ $product_id->created_at->format('Y-m-d  ') }}</td>
                    @endif
                @endforeach

            </tr>

        </table>
        <br><br><br><br>
        <table class="inventory">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th width='40'>Qty</th>
                    <th width='40'>Rate</th>
                    <th width='40'>GST (%)</th>
                    <th width='45'>Amount</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $key => $product_id)
                    <tr>
                        <td> {{ $product_id->product_id }} </td>
                        <td>{{ $product_id->quantity }} </td>
                        <td>{{ $product_id->unit_price }} </td>
                        {{-- <td>{{ $product_id->product_gst }} </td> --}}
                        <td>{{  $product_id->product_gst}} </td>
                        <td>{{ $product_id->sub_total  }} </td>


                    </tr>
                @endforeach


            </tbody>
        </table>
        <table class="balance" style='float:right'>
            <tr>
                <th> <b>Sub Total</b></th>

                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td> {{ $product_id->grand_total}}</td>
                    @endif
                @endforeach
            </tr>

            <tr>
                <th width='50'> CGST<b></b> </th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        {{-- <td> {{ $product_id->cgst  }}</td> --}}
                        <td> {{  ($product_id->cgst * $product_id->grand_total) / 100  }}</td>

                    @endif
                @endforeach
            </tr>
            <tr>
                <th width='50'> SGST<b></b> </th>
                @foreach ($data as $key => $product_id)


                    @if ($key === 0)
                        {{-- <td> {{ $product_id->sgst  }}</td> --}}
                        <td> {{  ($product_id->sgst * $product_id->grand_total) / 100  }}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th> <b> Total</b> </th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td> {{ $product_id->total +  $product_id->discount }}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th> <b>Discount</b></th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td> {{ $product_id->discount }}</td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <th> <b>Grand Total</b> </th>
                @foreach ($data as $key => $product_id)
                    @if ($key === 0)
                        <td> {{ $product_id->total }}</td>
                    @endif
                @endforeach
            </tr>
        </table>

    </article>
    @foreach ($data as $key => $product_id)
        @if ($key === 0)
            <h5 class='text-uppercase'> {{ $product_id->customer_name }}</h5>
        @endif
    @endforeach
    @foreach ($data as $key => $product_id)
        @if ($key === 0)
            <p>Rupees
                {{ ucfirst(\NumberFormatter::create('en_US', \NumberFormatter::SPELLOUT)->format($product_id->total)) }}
                only</p>
        @endif
    @endforeach
    <h4>Thankyou</h4>

</body>

</html>
