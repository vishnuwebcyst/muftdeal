<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\background;
use App\Models\Menu;
use App\Models\restaurant;
use App\Models\Slider;
use App\Models\itemType;
use App\Models\BankDetails;
use App\Models\food_type;
use App\Models\Rating;
use App\Models\User;

class RestaurantMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $id = $request->id;
        $ide = base64_decode($id);
        $data = restaurant::with('background')->find($ide);
        if (!$data) {

            return abort(22);
        }
        $menu = Menu::where('restaurant_id', $data->id)->orderBy('id', 'asc')->get();

        $menubackground = background::orderBy('id')->get();
        $sliders = Slider::where('restaurant_id', $data->id)->get();

        return view('front-end.RestaurantFood.index', compact('menu', 'data', 'menubackground', 'sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        // $id = $request->id;
        $ide = base64_decode($id);
        $rating = 0;

        if (auth()->check()) {
            $rating = Rating::where('restaurant_id', $ide)->first();
        }
        $data = restaurant::with('background')->find($ide);
        if (!$data) {
            return abort(404);
        }
        $menu = Menu::where('restaurant_id', $data->id)->when($request->search, function ($q) use ($request) {
            $q->where("item_name", "like", "%$request->search%")
                ->orWhere("small_price", "like", "%$request->search%")
                ->orWhere("medium_price", "like", "%$request->search%")
                ->orWhere("large_price", "like", "%$request->search%");
        })->get();

        $menu->rating  = '';
        if ($rating != null) {
            $menu->rating  = $rating->rating;
        }

        $foodTypes = food_type::where('restaurant_id', $data->id)->orderBy('position', 'asc')->get();
        $menuGrouped = $menu->groupBy('food_id');
        $item_types = itemType::with('menu_items')->where('restaurant_id', $data->id)->get();
        $menubackground = background::orderBy('id')->get();
        $sliders = Slider::where('restaurant_id', $data->id)->get();
        $reviews = Rating::where('restaurant_id', $ide)->get();

        $bank_details = BankDetails::where('restaurant_id', $data->id)->first();
        return view('front-end.RestaurantFood.index', compact('menu', 'data', 'menubackground', 'sliders', 'item_types', 'foodTypes', 'menuGrouped', 'reviews', 'bank_details'));
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
    }
}
