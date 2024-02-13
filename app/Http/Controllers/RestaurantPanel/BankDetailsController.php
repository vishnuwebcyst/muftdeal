<?php

namespace App\Http\Controllers\RestaurantPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BankDetails;
use App\Http\Requests\StoreBankDetailsRequest;
use App\Http\Requests\UpdateBankDetailsRequest;

class BankDetailsController extends Controller
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
        $data = BankDetails::where('restaurant_id', $restaurant_id)->first();
        $bank_detail = BankDetails::where('restaurant_id', $restaurant_id)->count();

        return view('RestaurantPanel.bank-details.index', compact('data', 'bank_detail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('RestaurantPanel.bank-details.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBankDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankDetailsRequest $request)
    {
        //
        $restaurant_id = auth()->guard('restaurant')->user()->id;


 $bank_details = new BankDetails();
 $bank_details->upi_id = $request->upi_id;
 $bank_details->restaurant_id = $restaurant_id;
 $bank_details->save();
        // return redirect()->back()->with('success', 'Bank Details added successfully');
        return redirect()->route('bank-details.index')->with('success', 'Bank Details Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankDetails  $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function show(BankDetails $bankDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankDetails  $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BankDetails $bankDetails)
    {

        $restaurant_id = auth()->guard('restaurant')->user()->id;


        $data = BankDetails::where('restaurant_id', $restaurant_id)->first();
         return view('RestaurantPanel.bank-details.edit', compact('data'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBankDetailsRequest  $request
     * @param  \App\Models\BankDetails  $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankDetailsRequest $request, BankDetails $bankDetails)
    {
        //

        BankDetails::where('id', $request->id)->update([
            'upi_id' => $request->upi_id,

        ]);
        return redirect()->back()->with('success', 'Bank Details Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankDetails  $bankDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankDetails $bankDetails, Request $request)
    {
        //
        BankDetails::where('id', $request->id)->delete();

        return redirect()->back()->with('success', 'Number Deleted successfully');
    }
}
