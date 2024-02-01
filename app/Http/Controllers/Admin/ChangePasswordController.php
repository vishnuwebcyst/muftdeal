<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = User::where('is_admin', 1)->first();

        return view('Admin.change-password', compact('data'));
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
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('is_admin', 1)->first();
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Invalid old Password');
        }
        $user->password = Hash::make($request->password);
        $user->show_pass = $request->password;
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully');

        // $validator = Validator::make($request->all(), [
        //     'password' => 'required',
        //     'name' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator) ;
        // }
        //  User::where('is_admin', $request->is_admin)->update([
        //     'name' => $request->name,
        //     'password' => Hash::make($request->password),
        //     'show_pass' =>  $request->password,
        // ]);

        // return redirect()->back()->with('success', 'Details Updated');
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
