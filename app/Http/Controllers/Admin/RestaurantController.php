<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Models\restaurant;
use App\Models\Menu;
use App\Models\City;
use App\Models\background;
use App\Models\itemType;
use App\Models\food_type;
use App\Http\Requests\StorerestaurantRequest;
use App\Http\Requests\UpdaterestaurantRequest;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = restaurant::where('is_verified', 1)->orderBy("id")->when($request->search, function ($q) use ($request) {
            $q->where("restaurant_name", "like", "%$request->search%")
                ->orWhere("city_name", "like", "%$request->search%")
                ->orWhere("location", "like", "%$request->search%"); // "like" condition for location
        })->paginate(50);

        $data->map(function ($data) {
            $details = Menu::where('restaurant_id', $data->id)->select("restaurant_id")->first(50);
            $data->restaurant_id = '';
            if (isset($details->restaurant_id)) {
                $data->restaurant_id = $details->restaurant_id;
            }
            return $data;
        });
        return view('Admin.restaurant.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $citys = City::orderBy('id')->get();
        return view('Admin.restaurant.add', compact('citys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorerestaurantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorerestaurantRequest $request)
    {
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->move(public_path('uploads/images/'), $filename);

        $main_file = $request->file('main_image');
        $main_filename = 'thumbnail_'. $file->getClientOriginalName();
        $main_file->move(public_path('uploads/images/'), $main_filename);

        $data = new restaurant();
        $data->city_name = $request->city_name;
        $data->restaurant_name = $request->restaurant_name;
        $data->image = $filename;
        $data->thumbnail = $main_filename;
        $data->password = Hash::make($request->password);

        $data->show_pass = $request->password;
        $data->phone = $request->phone;
        $data->is_verified = 1;
        $data->open_time = $request->open_time;
        $data->close_time = $request->close_time;
        $data->restaurant_type = $request->restaurant_type;
        $data->location = $request->location;
        $data->url = $request->url;
        $data->save();

        return redirect()->route('restaurant.index')->with('success', 'Restaurent Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $restaurantMenu, $id)
    {
        $data = restaurant::with('background')->find($id);
        $menu = Menu::with('itemType')->where('restaurant_id', $data->id)->paginate(10);
        $item_types = itemType::with('menu_items')->where('restaurant_id', $data->id)->get();
        $foodTypes = food_type::where('restaurant_id', $id)->get();
         $menubackground = background::orderBy('id')->get();
        //  dd($menu);
         return view('Admin.menu.index', compact('data', 'menu', 'menubackground', 'item_types', 'foodTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(restaurant $restaurant)
    {
        $citys = City::orderBy('id')->get();
        $data = restaurant::find($restaurant->id);
        return view('Admin.restaurant.edit', compact('data', 'citys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdaterestaurantRequest  $request
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdaterestaurantRequest $request, restaurant $restaurant)
    {
        $imaged = restaurant::where('id', $request->id)->first();
        if ($request->image) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads/images/'), $filename);
        } else {
            $filename = $imaged->image;
        }
        if ($request->main_image) {
            $main_file = $request->file('main_image');
            $main_filename = 'thumbnail_'. $main_file->getClientOriginalName();
            $main_file->move(public_path('uploads/images/'), $main_filename);
        } else {
            $main_filename = $imaged->main_image;
        }

        restaurant::where('id', $request->id)->update([
            'restaurant_name' => $request->restaurant_name,
            'restaurant_type' => $request->restaurant_type,
            'city_name' => $request->city_name,
            'image' => $filename,
            'thumbnail' => $main_filename,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
            'phone' => $request->phone,
            'location' => $request->location,
             'password' => Hash::make($request->password),
            'url' => $request->url,
        ]);
        return redirect()->route('restaurant.index')->with('success', 'Restaurant Details Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(restaurant $restaurant)
    {

        //

        $image = restaurant::where('id', $restaurant->id)->first();
        $image_path =  $image->image;
        $main_image_path =  $image->thumbnail;

        if (file_exists($image_path)) {
@unlink($image_path);
        }
        if (file_exists($main_image_path)) {
@unlink($main_image_path);
        }
        restaurant::find($restaurant->id)->delete();
        // restaurant::where('id', $restaurant->id)->delete();
        Menu::where('restaurant_id', $restaurant->id)->delete();
        food_type::where('restaurant_id', $restaurant->id)->delete();
        return redirect()->back()->with('success', "Restaurent Deleted Successfully");
    }

    public function download_qrcode(Request $request)

     {
$restaurantId = $request->restauran_id;

          $svgContent = QrCode::size(200)->generate(url('/', [base64_encode($restaurantId)]));


         $headers = [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'attachment; filename="example.svg"',
        ];


        return response($svgContent, 200, $headers);


    }


    public function admin_offer(Request $request, $id) {

        $this->validate($request, [

            'offers' => 'required',
         ]);
        // $restaurant_id = auth()->guard('restaurant')->user()->id;


        // $restaurant_id = auth()->guard('restaurant')->user()->id;
        $restaurant = restaurant::where('id', $id)->first();

        $restaurant->update([
             'offers' => $request->offers,
         ]);
                 return redirect()->back()->with('success', 'Offer Addedd successfully');


    }

    public function admin_offer_delete(Request $request, $id){
         $restaurant = restaurant::where('id', $id)->first();
        $restaurant->update([
             'offers' => null,
         ]);
          return redirect()->back()->with('success', 'Offer Deleted successfully');

    }


    public function pending_restaurant(Request $request) {

        $data = restaurant::where('is_verified', 0)->orderBy("id")->when($request->search, function ($q) use ($request) {
            $q->where("restaurant_name", "like", "%$request->search%")
                ->orWhere("city_name", "like", "%$request->search%")
                ->orWhere("location", "like", "%$request->search%"); // "like" condition for location
        })->paginate(10);


        return view('Admin.pending_restaurant' , compact('data'));
    }

    public function pending_restaurant_post(Request $request , $id) {


        $restaurant = restaurant::where('id', $id)->first();
        if($restaurant->is_verified == 1){
            return redirect()->back()->with('error', 'something went wrong');
        }

        restaurant::where('id', $id)->update([
            'is_verified' => 1,
            'url' => $request->url,
        ]);
        return redirect()->route('restaurant.index')->with('success', 'Restaurent Added Successfully');
    }
}
