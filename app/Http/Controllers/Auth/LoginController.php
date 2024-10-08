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
    protected $redirectTo = '/';

    public function login(Request $request)
    {   
        $input = $request->all();
        //dd($input);
  
        // $this->validate($request, [
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);
  
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
        {
            //return redirect('/admin');
            if(\Auth::user()->level == 'admin'){
                return redirect('/admin');
            }elseif(\Auth::user()->level == 'guru'){
                return redirect('/admin');
            }elseif(\Auth::user()->level == 'siswa'){
                return redirect('/home');
            }   
        }else{
            return redirect()->route('login')->with('error','Email-Address And Password Are Wrong.');
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
}
