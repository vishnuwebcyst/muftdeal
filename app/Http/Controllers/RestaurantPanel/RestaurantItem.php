<?php

namespace App\Http\Controllers\RestaurantPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\itemType;
class RestaurantItem extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = ItemType::orderBy('id')->where('restaurant_id', auth()->guard('restaurant')->user()->id)->get();

        return view('RestaurantPanel.menu.menu-types.index', compact('data'));
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
        // dd($restaurant_id);
        return view('RestaurantPanel.menu.menu-types.add', compact('restaurant_id'));

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

        foreach($request->title as $title) {

            $data = new itemType();
            $data->restaurant_id = $request->restaurant_id;
            $data->type = $title;
            $data->save();


        }

        // return redirect()->back()->with('success', 'type addedd successfully');
        // return redirect()->route('item-type.index', 'restaurant_id',$request->restaurant_id)->with('success', 'Type added successfully');
        return redirect()->route('restaurant-item.index', ['restaurant_id' => $request->restaurant_id])->with('success', 'Type added successfully');


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
        itemType::Where('id', $id)->update([
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Menu type updated successfully');
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
        itemType::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Menu type deleted successfully');
    }
}
