<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Restraunt;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:restraunt')->except('logout');
        $this->middleware('guest:web')->except('logout');
    }

    public function resSgnin()
    {
        return view('res-signin',
         [
             'url' => 'r/signin',
             'register' => '/',
             'resetPassUrl' => 'r-password-forget',
        ]);
    }

    public function showAdminLoginForm()
    {
        return view('res-signin',
         [
             'url' => 'admin/signin',
             'register' => 'admin/signup',
             'resetPassUrl' => 'admin-password-forget',
        ]);
        // return view('res-signin');
    }
    public function resAuth(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('restraunt')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            $res = Restraunt::where('email', $request->email)->first();
            return redirect()->route('r-dashboard', [$res->code]);
            // return redirect()->intended(route('r-dashboard', $res->code));
        }
        return back()->withInput($request->only('email', 'remember'));
    }
    public function adminAuth(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
}