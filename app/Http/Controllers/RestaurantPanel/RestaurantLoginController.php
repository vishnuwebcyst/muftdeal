<?php

namespace App\Http\Controllers\RestaurantPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\restaurant;
use App\Models\background;
use Illuminate\Support\Facades\Validator;
use App\Models\City;
use App\Models\itemType;
use Illuminate\Support\Facades\Hash;

class RestaurantLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        session(['restaurant_id' => auth()->guard('restaurant')->user()->id]);

        $restaurant = restaurant::where('id', auth()->guard('restaurant')->user()->id)->first();
        $menu_item = Menu::where('restaurant_id', auth()->guard('restaurant')->user()->id)->get();

        $total_menu = $menu_item->count();
        if (isset($menu_item->restaurant_id)) {
            $restaurant->restaurant_id = $menu_item->restaurant_id;
        }
        $data = ItemType::orderBy('id')->where('restaurant_id', auth()->guard('restaurant')->user()->id)->first();

        //
        return view("RestaurantPanel.restaurant.index", compact('restaurant', 'menu_item', 'total_menu', 'data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
    public function show($id)
    {
        //
        $data = restaurant::with('background')->find($id);
        $menu = Menu::where('restaurant_id', $data->id)->orderBy('id', 'asc')->paginate(10);

        $menubackground = background::orderBy('id')->get();
        return view('RestaurantPanel.restaurant.view', compact('data', 'menu', 'menubackground'));
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

        $data = restaurant::find($id);
        $citys = City::orderBy('id')->get();


        return view('RestaurantPanel.restaurant.edit', compact('data', 'citys'));
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
        $imaged = restaurant::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'city_name' => 'required',
            'restaurant_name' => 'required',
            // 'phone' => 'required',
            'location' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
            'url' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',


        ]);
        // If validation fails, return the errors to the user

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->with('error', 'There were validation errors. Please fix them and try again.');
        }
        if (isset($request->image)) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads/images/'), $filename);
        } else {
            $filename = $imaged->image;
        }
        if (isset($request->main_image)) {
            $main_file = $request->file('main_image');
            $main_filename = 'thumbnail_' .  $main_file->getClientOriginalName();
            $main_file->move(public_path('uploads/images/'), $main_filename);
        } else {
            $main_filename = $imaged->thumbnail;
        }

        restaurant::where('id', $request->id)->update([
            'city_name' => $request->city_name,
            'restaurant_name' => $request->restaurant_name,
            'image' => $filename,
            'thumbnail' => $main_filename,

            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
            'location' => $request->location,
            'description' => $request->description,
            'password' =>  Hash::make($request->password),
            'url' => $request->url,
        ]);
        return redirect()->route('restaurant-home.index')->with('success', 'Restaurant Updated Successfully');
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
    public function restaurant_login()
    {
        return view('RestaurantPanel.login');
    }

    public function menu_phone()
    {
        $data = restaurant::where('id', auth()->guard('restaurant')->user()->id)->first();

        return view('RestaurantPanel.edit_number', compact('data'));
    }
    public function post_menu_phone(Request $request, $id)
    {

        $restaurant = restaurant::where("id", $id)->first();
        $validator = Validator::make($request->all(), [
            'menu_number' => 'required|max:10|min:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'please Enter a valid number');
        }

        restaurant::where('id', $id)->update([
            'menu_number' => $request->menu_number,

        ]);

        return redirect()->back()->with('success', 'Phone number added successfully');
    }

    public function change_password(Request $request)
    {
        $this->validate($request, [
            'old_pass' => 'required',
            'new_pass' => 'required',
            'confirm_pass' => 'required',
        ]);
        $restaurant_id = auth()->guard('restaurant')->user()->id;

        if ($request->new_pass != $request->confirm_pass) {
            return redirect()->back()->with('error', 'Passwords do not match');
        }

        $restaurant = restaurant::where('id', $restaurant_id)->first();

        if (Hash::check($request->old_pass, $restaurant->password)) {

            $restaurant->update([
                'password' => Hash::make($request->new_pass),
                'show_pass' => $request->new_pass,
            ]);
            return redirect()->back()->with('success', 'Password Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Current Password is Wrong');
        }

        // return redirect()->back()->with('success', 'Password changed successfully');
    }

    public function offers(Request $request)
    {
        $this->validate($request, [

            'offers' => 'required',
        ]);
        $restaurant_id = auth()->guard('restaurant')->user()->id;
        $restaurant = restaurant::where('id', $restaurant_id)->first();

        $restaurant->update([
            'offers' => $request->offers,
        ]);
        return redirect()->back()->with('success', 'Offer Addedd successfully');
    }
    public function offer_delete(Request $request)
    {
        $restaurant_id = auth()->guard('restaurant')->user()->id;
        $restaurant = restaurant::where('id', $restaurant_id)->first();
        $restaurant->update([
            'offers' => null,
        ]);
        return redirect()->back()->with('success', 'Offer Deleted successfully');
    }
    public function restaurant_register()
    {
        $citys = City::orderBy('id')->get();

        return view('RestaurantPanel.register', compact('citys'));
    }
    public function restaurant_register_post(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'city_name' => 'required',
            'restaurant_name' => 'required',
            'phone' => 'required|unique:restaurants',
            'location' => 'required',
            'password' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
            // 'url' => 'required',
            'restaurant_type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
        }

        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->move(public_path('uploads/images/'), $filename);

        $main_file = $request->file('main_image');
        $main_filename = 'thumbnail_' . $main_file->getClientOriginalName();

        $main_file->move(public_path('uploads/images/'), $main_filename);

        $data = new restaurant();
        $data->city_name = $request->city_name;
        $data->restaurant_name = $request->restaurant_name;
        $data->image = $filename;
        $data->thumbnail = $main_filename;
        $data->password = Hash::make($request->password);
        $data->phone = $request->phone;
        $data->open_time = $request->open_time;
        $data->close_time = $request->close_time;
        $data->show_pass = $request->password;

        $data->restaurant_type = $request->restaurant_type;
        $data->location = $request->location;
        // $data->url = $request->url;
        $data->save();

        // return redirect()->route('restaurant-home.index');
        return redirect()->back()->with('success', 'Requset Send to admin');
    }


}
