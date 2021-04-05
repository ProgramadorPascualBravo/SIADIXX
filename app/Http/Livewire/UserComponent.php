<?php

namespace App\Http\Livewire;

use App\Department;
use App\Traits\ClearErrorsLivewireComponent;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use App\User;

class UserComponent extends Component
{
    use WithPagination, ClearErrorsLivewireComponent;

    public $view = 'create';

    public $user_id, $name, $last_name, $username, $department_id, $state, $verified;

    protected $listeners = ['errorNotUnique', 'edit'];

    public function render()
    {
        return view('livewire.user.user-component', [
            'departments'   => Department::all()
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
            'department_id' => 'required|exists:departments,id',
            'state'         => 'required',
            'verified'      => 'required'
        ]);

        $user                   = new User();
        $user->name             = $this->name;
        $user->last_name        = $this->last_name;
        $user->username         = $this->username;
        $user->department_id    = $this->department_id;
        $user->password         = Hash::make('1990duqe');
        $user->state            = $this->state;
        $user->verified         = $this->verified;
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
        $this->state            = $user->state;
        $this->verified         = $user->verified;
        $this->view             = 'edit';

    }

    public function update()
    {
        $this->validate([
            'name'          => 'required',
            'last_name'     => 'required',
            'department_id' => 'required',
            'state'         => 'required',
            'verified'      => 'required'
        ]);

        $user = User::find($this->user_id);
        try {

           $user->update([
               'name'          => $this->name,
               'last_name'     => $this->last_name,
               'department_id' => $this->department_id,
               'state'         => $this->state,
               'verified'      => $this->verified
           ]);
           $this->cancel();
           $this->emit('refreshLivewireDatatable');
           session()->flash('success', 'Usuario actualizado');
        } catch (QueryException $queryException) {
           $this->errorNotUnique();
        }

    }

    public function change_state($id)
    {
        $user =         User::find($id);
        $user->state =  !$user->state;
        $user->save();
        session()->flash('success', 'Acción realizada.');

    }

    public function cancel()
    {
        $this->user_id          = '';
        $this->name             = '';
        $this->last_name        = '';
        $this->username         = '';
        $this->department_id    = '';
        $this->password         = '';
        $this->state            = '';
        $this->verified         = '';
        $this->view             = 'create';
        $this->hydrate();
    }

    public function errorNotUnique()
    {
       session()->flash('error', 'Error al editar el usuario.');
    }
}
