<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    protected function attemptLogin(Request $request)
    {
        //dd("attempt login");
        #fungsi check apakah inputan email terdapat prefix . sebelum @
        $explode = explode("@", $request->email);
        $explode[0] = str_replace(".", "", $explode[0]);
        $email = implode("@", $explode);

        // dump($request->password);
        // dump($email);
        // dd($request->email);

        return (auth()->attempt(['email' => $request->email, 'password' => $request->password]));
        //return (auth()->attempt(['emailnodot' => $email, 'password' => $request->password]));
    }
    protected function authenticated(Request $request, $user)
    {
      

      
        $email = ($request->email);
        #use this code for show value
        // $password = ($request->password);
        // dump($user);
        // dump($user->hasRole('admin02'));
        // dd($email);
        // if (($email == 'adminsg02')&&($password=='$umatraKopi88')) {

        //     return redirect('/adminawb/dashboard');
        // }


        // if ($user->isAdmin()) { // do your magic here
        //     return redirect()->route('dashboard');
        // }
        // dump($user);
        // dump($user->id);
        // dump($user->name);
        // dump($user);
        // dd("test auth");
        if ($user->hasRole('Admin')) {
            return redirect('/dashboard');
        } 
        else if ($user->hasRole('admin01')) {
            return redirect('/dashboard');
        }
        else if ($user->hasRole('admin02')) {
            return redirect('/dashboard');
        } else  if ($user->hasRole('member')) {
            $totalcart = Cart::getTotal();
            if ($totalcart == 0) {
                return redirect('/member/board');
            }
            else
            {
                return redirect('/fcheckouts');
            }
          
            
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        // return view('auth.login');
        $title = "Sign In";
        $pages = "signin";
        return view('front.login', compact('title', 'pages'));
    }
}
