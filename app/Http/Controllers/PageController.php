<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function singin(Request $request)
    {
        $request->validate([
            'username' => 'required|email:rfc',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
        return redirect(route('login'));
    }

    public function logout ()
    {
        Auth::logout();
        Session::flush();
        return redirect(route('login'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    //Metodos ingresos a módulos

    public function user()
    {
        return view('user.index');
    }

    public function department()
    {
        return view('department.index');
    }

    //Fin de ingreso
}
