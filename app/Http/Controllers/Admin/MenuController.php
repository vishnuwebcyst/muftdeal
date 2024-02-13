<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\background;
use App\Http\Controllers\Controller;
use App\Models\itemType;
use App\Models\restaurant;
use App\Models\menu_items;
use App\Models\food_type;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $restaurant_id = $request->restaurant_id;
        $types = itemType::where('restaurant_id', $restaurant_id)->get();
        $data = food_type::orderBy('id')->where('restaurant_id', $request->restaurant_id)->get();
        $item_types = itemType::where('restaurant_id', $restaurant_id)->get();

        return view('Admin.menu.add', compact('restaurant_id', 'types', 'data', 'item_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        //
        if ($request->small_price === null && $request->medium_price === null && $request->large_price === null) {

            return redirect()->back()->with('error', 'Please fill at least one price.');
        }
        $data = new Menu();
        $data->restaurant_id = $request->restaurant_id;
        $data->item_name = $request->item_name;
        $data->gst = $request->gst;

        $data->small_price = $request->small_price;
        $data->medium_price = $request->medium_price;
        $data->large_price = $request->large_price;
        $data->food_id = $request->food_id;
        $data->save();
        return redirect()->back()->with('success', 'Menu Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = restaurant::with('background')->find($id);
        $item_types = itemType::with('menu_items')->where('restaurant_id', $data->id)->get();
        $menu = Menu::where('restaurant_id', $data->id)->orderBy('id', 'asc')->get();
        $foodTypes = food_type::where('restaurant_id', $data->id)->get();
        $menuGrouped = $menu->groupBy('food_id');
        $data1 = menu_items::where('restaurant_id', $data->id)->get();
        $menubackground = background::orderBy('id')->get();

        return view('Admin.menu.show', compact('data', 'menu', 'menubackground', 'item_types', 'data1' ,'foodTypes', 'menuGrouped'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        // dd($menu);
        //
        $menu::where('id', $menu->id)->update([
            'restaurant_id' => $request->restaurant_id,
            'item_name' => $request->item_name,
            'gst' => $request->gst,

            'small_price' => $request->small_price,
            'medium_price' => $request->medium_price,
            'large_price' => $request->large_price,
        ]);
        // menuItem::where()


        return redirect()->back()->with('success', 'Item Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
        Menu::find($menu->id)->delete();
        return redirect()->back()->with('success', 'Item Deleted Successfully');
    }
    public function getImage(Request $request)
    {
        $imagePath = $request->input('image');
        $imageid = $request->image_id;
        $image = background::where('id', $imageid)->first();
        restaurant::where('id', $request->restaurant_id)->update([
            'background_id' => $imageid,
        ]);
        return response()->json(['image_url' => $image->image, 'text_color' => $image->color]);
    }
    public function selectimage(Request $request)
    {
        $imageUrl = $request->input('imageUrl');
        return response()->json(['imageUrl' => $imageUrl]);
    }
    public function menucard($id)
    {
        $ide = base64_decode($id);
        $data = restaurant::with('background')->find($ide);
        if (!$data) {

            return abort(404);
        }

        $item_types = itemType::with('menu_items')->where('restaurant_id', $data->id)->get();

        $menu = Menu::where('restaurant_id', $data->id)->get();
        // $foodTypes = food_type::where('restaurant_id', $data->id)->get();
        $foodTypes = food_type::where('restaurant_id', $data->id)->orderBy('position', 'asc')->get();

        $menuGrouped = $menu->groupBy('food_id');


        $menubackground = background::orderBy('id')->get();

        return view('menu', compact('data', 'menu', 'menubackground', 'item_types' , 'menuGrouped', 'foodTypes'));
    }
}
