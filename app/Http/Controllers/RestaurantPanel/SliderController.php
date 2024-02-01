<?php

namespace App\Http\Controllers\RestaurantPanel;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
          $sliders = Slider::where('restaurant_id' ,auth()->guard('restaurant')->user()->id)->get();
         return view('restaurantPanel.sliders.index' , compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        return view('restaurantPanel.sliders.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',

        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->with('error', 'Please Check your image');
        }
        $imageName = 'uploads/' . time() . '.' . $request->image->extension();

        $request->image->move(public_path('uploads/'), $imageName);

        $data = new Slider();
        $data->image = $imageName;
        $data->restaurant_id = $request->restaurant_id;
         $data->save();
        //  return redirect()->back()->with('success', 'Slider image added successfully');
         return redirect()->route('restaurant-sliders.index')->with('success', 'Slider image added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         Slider::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Slider Image delted successfully');
    }
}
