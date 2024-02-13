<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use App\Http\Controllers\Controller;
use App\Models\restaurant;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatableTrait;

    protected $table = 'restaurants';

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function restaurant_details_check(Request $request)
    {
        $user = Restaurant::where('phone', $request->input('phone'))->first();

         if (auth()->guard('restaurant')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            if($user->is_verified  == 0) {
                return redirect()->back()->with('error', 'permission denied');

            }
            $authenticatedUser = auth()->guard('restaurant')->user();
             return redirect()->route('restaurant-home.index');
        }
         else {
             return redirect()->back()->with('error', 'Phone number or password is invalid');
        }

    }

}
