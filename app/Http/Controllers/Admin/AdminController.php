<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function adminlogin_check(Request $request)
    {
         $input = $request->all();
        //  $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
         $validated  = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
          if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            } else {
                return redirect()->back()->withErrors(['email' => 'Email-Address And Password Are Wrong.']);
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'Email-Address And Password Are Wrong.']);
        }
    }
    public function admin_login()
    {

        return view('admin.login');
    }

}
