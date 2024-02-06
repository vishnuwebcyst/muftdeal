<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $citys = City::orderBy('id')->paginate(10);
        return view('Admin.city.index', compact('citys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.city.add');

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
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->move(public_path('uploads/images/'), $filename);
        $city = new City();
        $city->city_name = $request->city_name;
        $city->image = $filename;
        $city->save();

        return redirect()->route('all-city.index')->with('success', 'City added successfully');
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
        $imaged = City::where('id', $request->id)->first();
        if ($request->image) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads/images/'), $filename);
        } else {
            $filename = $imaged->image;
        }
         City::where('id', $request->city_id)->update([
            'city_name' => $request->city_name,
            'image' => $filename,
        ]);
        return redirect()->back()->with('success', 'City Name Updated');
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
        $image = City::where('id', $id)->first();
        $image_path = 'uploads/images/'. $image->image;

        if (file_exists($image_path)) {
@unlink($image_path);
        }

        City::where('id', $id)->delete();
        return redirect()->back()->with('success', 'City deleted successfully');
    }
}
