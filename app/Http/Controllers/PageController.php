<?php

namespace App\Http\Controllers;

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
        /*$role = Role::create([
            'name' => 'writer'
        ]);
        //auth()->user()->givePermissionTo('create program');
        //auth()->user()->assignRole('writer');
        return auth()->user()->permissions;

        /*$permission = Permission::create([
            'name' => 'create program'
        ]);
        $role = Role::findById(1);
        //$permission = Permission::findById(1);

        $role->givePermissionTo($permission);
        //$role->givePermissionTo($permission);
        //$permission->assignRole($role);
        */
        return view('dashboard');
    }

    //Metodos ingresos a módulos

    public function user()
    {
        return view('user.index');
    }

    public function student()
    {
       return view('student.index');
    }

    public function studentMassCreation()
    {
       return view('student.mass-creation');
    }

    public function department()
    {
        return view('department.index');
    }

    public function program()
    {
        return view('program.index');
    }

    public function course()
    {
        return view('course.index');
    }

    public function group()
    {
        return view('group.index');
    }

    public function rol_moodle()
    {
       return view('rol_moodle.index');
    }

    public function enrollment()
    {
       return view('enrollment.index');
    }

   public function enrollmentMassCreation()
   {
      return view('enrollment.mass-creation');
   }
    //Fin de ingreso
}
