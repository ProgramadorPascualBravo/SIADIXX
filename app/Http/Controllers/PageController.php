<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PageController extends Controller
{

    public function index()
    {

        return view('index');
    }

    public function singin(Request $request)
    {
        $request->validate([
            'username' => 'required|email:rfc|exists:users,username,state,1',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
        return redirect(route('login'))->withErrors(['failed' => 'Estas credenciales no coinciden con nuestros registros. ']);
    }

    public function logout ()
    {
        Auth::logout();
        Session::flush();
        return redirect(route('login'));
    }

    public function verify($code)
    {
       $user = User::where('confirmation_code', $code)->first();
       if (! is_null($user)) {
         $user->email_verified_at = Carbon::now('America/Bogota')->toDateTimeString();
         $user->verified = 1;
         $user->save();
         Auth::login($user);
         return redirect()->intended('dashboard');
       }
       return view('email_verified.error');
    }
}
