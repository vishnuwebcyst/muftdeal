<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\background;
use App\Http\Requests\StorebackgroundRequest;
use App\Http\Requests\UpdatebackgroundRequest;
use Illuminate\Support\Facades\Validator;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menubackground = background::where('restaurant_id', 0)->orderBy('id')->get();

        return view('Admin.backgrounds.index', compact('menubackground'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.backgrounds.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorebackgroundRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorebackgroundRequest $request)
    {
        //



        $imageName = 'uploads/' . time() . '.' . $request->image->extension();

        $request->image->move(public_path('uploads/'), $imageName);

        $data = new background();
        $data->image = $imageName;
        $data->color = $request->color;
        $data->save();
        return redirect()->route('background.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\background  $background
     * @return \Illuminate\Http\Response
     */
    public function show(background $background)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\background  $background
     * @return \Illuminate\Http\Response
     */
    public function edit(background $background)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebackgroundRequest  $request
     * @param  \App\Models\background  $background
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebackgroundRequest $request, background $background)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\background  $background
     * @return \Illuminate\Http\Response
     */
    public function destroy(background $background)
    {
        //
        $image = background::where('id', $background->id)->first();
        $image_path =  $image->image;

        if (file_exists($image_path)) {
            @unlink($image_path);
        }
        background::find($background->id)->delete();
        return redirect()->back()->with('success', 'Background image deleted successfully');
    }
}
