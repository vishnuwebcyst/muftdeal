<?php

namespace App\Http\Controllers\RestaurantPanel;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\itemType;
use App\Http\Requests\StoreitemTypeRequest;
use App\Http\Requests\UpdateitemTypeRequest;

class ItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //
        $data = ItemType::orderBy('id')->where('restaurant_id', $request->restaurant_id)->get();

        return view('RestaurantPanel.menu.menu-types.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

//  dd($request)
        $restaurant_id = $request->restaurant_id;
        return view('RestaurantPanel.menu.menu-types.add', compact('restaurant_id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreitemTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreitemTypeRequest $request)
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
        return redirect()->route('item-type.index', ['restaurant_id' => $request->restaurant_id])->with('success', 'Type added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\itemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function show(itemType $itemType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\itemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function edit(itemType $itemType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateitemTypeRequest  $request
     * @param  \App\Models\itemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateitemTypeRequest $request, itemType $itemType)
    {
        //
        itemType::Where('id', $itemType->id)->update([
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Menu type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\itemType  $itemType
     * @return \Illuminate\Http\Response
     */
    public function destroy(itemType $itemType)
    {
        //

        itemType::where('id', $itemType->id)->delete();

        return redirect()->back()->with('success', 'Menu type deleted successfully');
    }
}
