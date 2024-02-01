<?php


namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\menu_items;
use App\Models\Menu;
use App\Http\Requests\Storemenu_itemsRequest;
use App\Http\Requests\Updatemenu_itemsRequest;

class MenuItemsController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storemenu_itemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storemenu_itemsRequest $request)
    {
        $data = new Menu();
        $data->restaurant_id = $request->restaurant_id;
        $data->item_name = $request->item_name;
        $data->save();

        $menu_items = new Menu_items();
        $menu_items->restaurant_id = $request->restaurant_id;
        $menu_items->item_type = $request->item_type;
        $menu_items->menu_id = $data->id;
        $menu_items->price = $request->price;
        $menu_items->save();

        return redirect()->back()->with('success', 'Menu item added successfully');
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\menu_items  $menu_items
     * @return \Illuminate\Http\Response
     */
    public function show(menu_items $menu_items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\menu_items  $menu_items
     * @return \Illuminate\Http\Response
     */
    public function edit(menu_items $menu_items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatemenu_itemsRequest  $request
     * @param  \App\Models\menu_items  $menu_items
     * @return \Illuminate\Http\Response
     */
    public function update(Updatemenu_itemsRequest $request, menu_items $menu_items)
    {

        menu_items::where('menu_id', $request->menu_id)->delete();

        foreach($request->price as $key => $price) {
            $data = new menu_items();
            $data->restaurant_id = $request->restaurant_id;
            $data->menu_id = $request->menu_id;
            $data->price = $price;
            $data->item_type = $request->item_type[$key];
            $data->save();
        }
        Menu::where('id', $menu_items->menu_id)->update([
            'restaurant_id' => $request->restaurant_id,
            'item_name' => $request->item_name,
        ]);

        return redirect()->back()->with('success', 'Item Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\menu_items  $menu_items
     * @return \Illuminate\Http\Response
     */
    public function destroy(menu_items $menu_items)
    {
        //
    }
}
