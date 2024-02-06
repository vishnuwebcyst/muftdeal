<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Rating;
use App\Models\restaurant;
use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(Request $request)
    {
        $sliders = Slider::where('restaurant_id', '==', 0)->get();
        // $restaurants = restaurant::where('is_verified', 1)->get();
        $restaurants = restaurant::where('is_verified', 1)->orderBy("id")->when($request->search, function ($q) use ($request) {
            $q->where("restaurant_name", "like", "%$request->search%");

         })->paginate(50);

        $restaurants->map(function ($data) {
            $details =  Rating::where('restaurant_id', $data->id)->count();

            $rating = Rating::where('restaurant_id', $data->id)->sum('rating');
            //  $data->rating = "No rating yet";
             $data->rating = "";
            if($details > 0 ){
                    $data->rating = round($rating/$details,1) ;
            }

            return $data;
        });
        // $restaurants = $restaurants->sortByDesc('rating');
        $cityName = $request->input('city_name');

        if ($cityName) {
            // $restaurants = Restaurant::where('city_name', $cityName)
            //     ->where('is_verified', 1)
            //     ->get();
                $restaurants = restaurant::where('city_name', $cityName)->Where('is_verified', 1)->orderBy("id")->when($request->search, function ($q) use ($request) {
                    $q->where("restaurant_name", "like", "%$request->search%");
                 })->paginate(50);

            return response()->json($restaurants);
        }
        // $citys = City::orderBy('id', 'asc')->get();
        $cities = City::orderBy('city_name', 'asc')->get();

        if (session()->has('city_name')) {
            // $restaurants = restaurant::Where("city_name", session('city_name'))->Where('is_verified', 1)->get();
            $restaurants = restaurant::where('city_name', session('city_name'))->orderBy("id")->when($request->search, function ($q) use ($request) {
                $q->where("restaurant_name", "like", "%$request->search%");
             })->get();
         }
        return view('welcome', compact('restaurants', 'sliders', 'cities'));
    }

    public function search_bar(Request $request)
    {
        $data = restaurant::where('is_verified',  1)->orWhere("city_name", "like", "%$request->name%")->orWhere("restaurant_name", "like", "%$request->name%")->first();
        Log::info($data);
        return response()->json($data);
    }

    public function selectCity(Request $request)
    {
        return redirect()->back();
    }
    public function abount_us(){
        $sliders = Slider::where('restaurant_id', '==', 0)->get();
        return view('front-end.about-us', compact('sliders'));
    }

    public function contact() {
        $sliders = Slider::where('restaurant_id', '==', 0)->get();

        return view('front-end.contact', compact('sliders'));
    }

    public function select_city(Request $request){

        // $restaurants = restaurant::Where("city_name", $request->city_name)->Where('is_verified', 1)->get();
        $restaurants = restaurant::where('city_name',  $request->city_name)->where('is_verified', 1)->when($request->search, function ($q) use ($request) {
            $q->where("restaurant_name", "like", "%$request->search%");
         })->get();
        session(['city_name' => $request->city_name]);

        return response()->json(['restaurants' => $restaurants]);

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
}
