<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\food_type;
use Illuminate\Http\Request;
use App\Models\Menu;

use App\Http\Requests\Storefood_typeRequest;
use App\Http\Requests\Updatefood_typeRequest;
// use App\Models\ItemType;
class FoodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // return view('Admin.menu.food-type.index');
        $data = food_type::orderBy('id')->where('restaurant_id', $request->restaurant_id)->get();

        return view('Admin.menu.food-type.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $restaurant_id = $request->restaurant_id;

        // dd($deails);

        return view('Admin.menu.food-type.add', compact('restaurant_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storefood_typeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storefood_typeRequest $request)
    {
        //
        // dd($request->all());

        $lastEntry = food_type::latest()->first();
        $position = $lastEntry ? $lastEntry->position + 1 : 1;

        $data = new food_type();
        $data->restaurant_id = $request->restaurant_id;
        $data->food_type = $request->food_type;
        $data->position = $position;
        $data->item_type = json_encode($request->item_type);
        $data->save();



        return redirect()->back()->with('success', 'Category addedd successfully');
        // return redirect()->route('item-type.index', 'restaurant_id',$request->restaurant_id)->with('success', 'Type added successfully');
        // return redirect()->route('food-type.index', ['restaurant_id' => $request->restaurant_id])->with('success', 'Category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\food_type  $food_type
     * @return \Illuminate\Http\Response
     */
    public function show(food_type $food_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\food_type  $food_type
     * @return \Illuminate\Http\Response
     */
    public function edit(food_type $food_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatefood_typeRequest  $request
     * @param  \App\Models\food_type  $food_type
     * @return \Illuminate\Http\Response
     */
    public function update(Updatefood_typeRequest $request, food_type $food_type)
    {
        //
        food_type::Where('id', $food_type->id)->update([
            'food_type' => $request->food_type,
            'item_type' => json_encode($request->item_type),

        ]);

        return redirect()->back()->with('success', 'Menu type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\food_type  $food_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(food_type $food_type)
    {
        $check_food = Menu::where('food_id', $food_type->id)->first();
        if ($check_food) {
            return redirect()->back()->with('error', 'first delete all menu item this type');
        }
        food_type::where('id', $food_type->id)->delete();
        return redirect()->back()->with('success', 'Menu type deleted successfully');
    }
}
