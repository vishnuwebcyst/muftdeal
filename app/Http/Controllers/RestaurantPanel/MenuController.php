<?php

namespace App\Http\Controllers\RestaurantPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\background;
use App\Models\restaurant;
use App\Models\itemType;
use App\Models\food_type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
// use Imagick;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Imagick\Facades\Imagick;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        //
        $data = food_type::orderBy('id')->where('restaurant_id', $request->restaurant_id)->get();

        $restaurant_id = auth()->guard('restaurant')->user()->id;
        return view('RestaurantPanel.menu.add', compact('restaurant_id', 'data'));
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
            'item_name' => 'required',
            'food_id' => 'required',


        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
        }
            if ($request->small_price === null && $request->medium_price === null && $request->large_price === null) {

                return redirect()->back()->with('error', 'Please fill at least one price.');
            }

        $data = new Menu();
        $data->restaurant_id = $request->restaurant_id;
        $data->item_name = $request->item_name;
        $data->small_price = $request->small_price;
        $data->medium_price = $request->medium_price;
        $data->large_price = $request->large_price;
        $data->food_id = $request->food_id;
        $data->save();


        // return redirect()->route('restaurant-menu.show', [$request->restaurant_id])->with('success', 'Item Added Successfully');
        return redirect()->back()->with('success', 'Item added successfully');
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



        return view('RestaurantPanel.menu.index', compact('data', 'menu'));
    }
    public function view()
    {

        $data = restaurant::find(auth()->guard('restaurant')->user()->id);
        $menu = Menu::where('restaurant_id', $data->id)->get();
        $menubackground = background::where('restaurant_id', $data->id)->orderBy('id')->get();
        $item_types = itemType::with('menu_items')->where('restaurant_id', $data->id)->get();
        $menu = Menu::where('restaurant_id', $data->id)->orderBy('id', 'asc')->get();
        $foodTypes = food_type::where('restaurant_id', $data->id)->get();
        $menuGrouped = $menu->groupBy('food_id');

        return view('RestaurantPanel.menu.show', compact('data', 'menu', 'menubackground', 'item_types', 'foodTypes', 'menuGrouped'));
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

        $validator = Validator::make($request->all(), [
            'item_name' => 'required',

        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->with('error', 'The item name field is required');
        }
        Menu::where('id', $id)->update([
            'item_name' => $request->item_name,
            'small_price' => $request->small_price,
            'medium_price' => $request->medium_price,
            'large_price' => $request->large_price,
        ]);
        return redirect()->back()->with('success', 'Item Updated Successfully');
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
        Menu::find($id)->delete();
        return redirect()->back()->with('success', 'Item Deleted Successfully');
    }

    public function selectImage(Request $request)
    {
        $testagePath = $request->input('image');
        $testageid = $request->image_id;
        $testage = background::where('id', $testageid)->first();
        Log::info($request);
        restaurant::where('id', $request->restaurant_id)->update([
            'background_id' => $testageid,
        ]);
        return response()->json(['image_url' => $testage->image, 'text_color' => $testage->color]);
    }


    public function downloadQrCode(Request $request)

    {

    $restaurantId = $request->restaurant_id;
    $svgContent = QrCode::size(300)->generate(url('/', [base64_encode($restaurantId)]));
    // $svgContent = QrCode::size(300)->generate('websyst.in');


    $headers = [
        'Content-Type' => 'image/svg+xml',
        'Content-Disposition' => 'attachment; filename="qrcode.svg"',
    ];

    return response($svgContent, 200, $headers);
    }
    public function backgrounds() {
        $restaurant_id = auth()->guard('restaurant')->user()->id;

        $menubackground = background::where('restaurant_id', $restaurant_id)->orderBy('id')->get();

        return view('RestaurantPanel.backgrounds.index', compact('menubackground'));
    }

    public function background_add() {
        return view('RestaurantPanel.backgrounds.add');
    }

    public function background_post(Request $request) {
        $validator = Validator::make($request->all(), [
            'color' => 'required',

            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
        }

        $restaurant_id = auth()->guard('restaurant')->user()->id;

          $imageName = 'uploads/' . time()  . '.' . $request->image->extension();

        $request->image->move(public_path('uploads/'), $imageName);
        $data = new background();
        $data->image = $imageName;
        $data->restaurant_id = $restaurant_id;
        $data->color = $request->color;
        $data->save();
        return redirect()->route('restaurant.background')->with('success', 'Background image added successfully!');
    }

    public function background_delete(Request $request ,$id) {

        $image = background::where('id', $id)->first();
        $image_path =  $image->image;

        if (file_exists($image_path)) {
            @unlink($image_path);
        }
        background::find($id)->delete();
        return redirect()->back()->with('success', 'Background image deleted successfully');

    }

    public function remove_background(Request $request) {
        $restaurant_id = auth()->guard('restaurant')->user()->id;

        restaurant::where('id', $restaurant_id)->update([

             'background_id' => null,
        ]);
        return redirect()->back()->with('success', 'Background Remove Successfully');


    }
}
