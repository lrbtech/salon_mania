<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    // public function login(Request $request)
    // {
    //   // Validate the form data
    //   $this->validate($request, [
    //     'email'   => 'required|email',
    //     'password' => 'required|min:6'
    //   ]);

    //   // Attempt to log the user in
    //   if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' =>1], $request->remember)) {
    //     // if successful, then redirect to their intended location
    //     return redirect()->intended(route('vendor.dashboard'));
    //   }

    //   // if unsuccessful, then redirect back to the login with the form data
    //   return redirect()->back()->withInput($request->only('email', 'remember'));
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
