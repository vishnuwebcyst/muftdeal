<?php

namespace App\Http\Controllers\RestaurantPanel;

use App\Models\Menu;

use App\Http\Controllers\Controller;
use App\Models\Billings;

use App\Models\City;
use App\Models\Rating;
use App\Models\restaurant;
use App\Models\Slider;
use App\Models\BillingItems;
use App\Http\Requests\StoreBillingsRequest;
use App\Http\Requests\UpdateBillingsRequest;
use PDF;

class BillingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $restaurant_id = auth()->guard('restaurant')->user()->id;

        $data = Billings::Where('restaurant_id', $restaurant_id)->orderBy('id')->with('billingItems')->get();

        return view('RestaurantPanel.billing.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $restaurant_id = auth()->guard('restaurant')->user()->id;
        $products = Menu::where('restaurant_id', $restaurant_id)->get();

        return view('RestaurantPanel.billing.add', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBillingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillingsRequest $request)
    {

        $restaurant_id = auth()->guard('restaurant')->user()->id;


        $billing = new Billings();
        $billing->restaurant_id = $restaurant_id;
        $billing->customer_name = $request->customer_name;
        $billing->customer_phone = $request->customer_phone;
        $billing->invoice_number = time();
        $billing->gst = $request->gst;
        $totalAmount = $request->total;
        $gstPercentage = $request->gst;
        $gstAmount = ($gstPercentage * $totalAmount) / 100;
        $discount = $request->discount;
        $totalAmount -= $discount;
        $billing->discount = $request->discount;
        $billing->cgst =   $request->cgst;
        $billing->sgst =   $request->sgst;
        $billing->grand_total = $request->sub_total;
        $billing->total = $request->total;
        $billing->save();

        $products = Menu::where('id', $request->product_id)->get();
        $numberOfProducts = count($request->product_id);
// $gstPercentage = $request->gst + ;
// $gstPercentage = $request->gst *  $request->sub_total / 100 ;

foreach ($request->product_id as $key => $product_id) {
            $gstPerProduct = $gstPercentage / $numberOfProducts;

            $data = new BillingItems();
            $data->billing_id = $billing->id;
            $data->product_id = $product_id;
            $data->product_gst = $request->gst;
            $data->quantity = $request->qty[$key];
            $data->variant_type = $request->variant_type[$key];
            $data->unit_price = $request->product_price[$key];
            $data->sub_total = $request->total_price[$key];
            $data->total_price = $request->total;
            $data->save();
        }

        $totalAmount = $request->total + $request->discount;

        $gstPercentage = $request->gst;

        $gstAmount = ($gstPercentage * $totalAmount) / 100;
        $dataa = BillingItems::join("billings","billing_items.billing_id","billings.id")->where("billing_items.billing_id",$billing->id)->get();

        $restaurant = auth()->guard('restaurant')->user();
         $pdf = PDF::loadView('RestaurantPanel.billing.invoice', ['data' => $dataa,   'gst' => $gstAmount, 'restaurant' => $restaurant]);
        $fileName = 'invoice_' . time() . '.pdf';

        return $pdf->download($fileName);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Billings  $billings
     * @return \Illuminate\Http\Response
     */
    public function show(Billings $billings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Billings  $billings
     * @return \Illuminate\Http\Response
     */
    public function edit(Billings $billings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBillingsRequest  $request
     * @param  \App\Models\Billings  $billings
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBillingsRequest $request, Billings $billings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Billings  $billings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billings $billings)
    {
        //
    }

    public function invoice($id)
    {

    $data =    BillingItems::join("billings","billing_items.billing_id","billings.id")->where("billing_items.billing_id",$id)->get();

$gst = '1';
        $restaurant = auth()->guard('restaurant')->user();

         return view('RestaurantPanel.billing.invoice', ['data' => $data, 'restaurant' => $restaurant, 'gst' => $gst]);

    }
}
