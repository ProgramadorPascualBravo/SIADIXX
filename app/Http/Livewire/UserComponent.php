<?php

namespace App\Http\Livewire;

use App\Departament;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use App\User;

class UserComponent extends Component
{
    use WithPagination;
    public $view = 'create';

    public $user_id, $name, $last_name, $username, $department_id;
    public function render()
    {
        return view('livewire.user.user-component', [
            'users' => User::orderBy('id', 'desc')->paginate(15),
            'departments' => Departament::all()
        ]);
    }

    public function destroy($id)
    {
        session()->flash('success', 'Usuario eliminado.');
        User::destroy($id);
    }

    public function store()
    {
        $this->validate([
            'name'          => 'required',
            'last_name'     => 'required',
            'username'      => 'required|email:rfc|unique:users,username',
            'department_id' => 'required|exists:departments,id'
        ]);

        $user                   = new User();
        $user->name             = $this->name;
        $user->last_name        = $this->last_name;
        $user->username         = $this->username;
        $user->department_id    = $this->department_id;
        $user->password         = Hash::make('1990duqe');
        $user->save();
        session()->flash('success', 'Usuario creado.');

    }

    public function edit($id)
    {
        $user                   = User::find($id);
        $this->user_id          = $user->id;
        $this->name             = $user->name;
        $this->last_name        = $user->last_name;
        $this->username         = $user->username;
        $this->department_id    = $user->department_id;
        $this->view             = 'edit';

    }

    public function update()
    {
        $this->validate([
            'name'          => 'required',
            'last_name'     => 'required',
            'department_id' => 'required'
        ]);

        $user = User::find($this->user_id);
        $user->update([
            'name'          => $this->name,
            'last_name'     => $this->last_name,
            'department_id' => $this->department_id
        ]);

        $this->cancel();
    }
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cancel()
    {
        $this->user_id          = '';
        $this->name             = '';
        $this->last_name        = '';
        $this->username         = '';
        $this->department_id    = '';
        $this->password         = '';
        $this->view             = 'create';
        $this->hydrate();
    }
}
