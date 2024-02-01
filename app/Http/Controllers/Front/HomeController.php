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
        $restaurants = restaurant::where('is_verified', 1)->get();
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
        $restaurants = $restaurants->sortByDesc('rating');


        if (session()->has('city_name')) {
            $restaurants = restaurant::Where("city_name", session('city_name'))->Where('is_verified', 1)->get();
        }
        return view('welcome', compact('restaurants', 'sliders'));
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
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
}
