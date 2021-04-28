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

    public $user_id, $name, $last_name, $username, $document, $department_id, $state;

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
            'document'      => 'required|unique:users,document',
            'department_id' => 'required|exists:departments,id',
            'state'         => 'required'
        ]);

        $user                   = new User();
        $user->name             = $this->name;
        $user->last_name        = $this->last_name;
        $user->username         = $this->username;
        $user->document         = $this->document;
        $user->department_id    = $this->department_id;
        $user->password         = Hash::make($this->document);
        $user->state            = $this->state;
        $user->save();
        $this->cancel();
        $this->emit('refreshLivewireDatatable');
        session()->flash('success', 'Usuario creado.');

    }

    public function edit($id)
    {
        $user                   = User::find($id);
        $this->user_id          = $user->id;
        $this->name             = $user->name;
        $this->last_name        = $user->last_name;
        $this->username         = $user->username;
        $this->document         = $user->document;
        $this->department_id    = $user->department_id;
        $this->state            = $user->state;
        $this->view             = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name'          => 'required',
            'last_name'     => 'required',
            'department_id' => 'required',
            'state'         => 'required',
        ]);

        $user = User::find($this->user_id);
        try {

           $user->update([
               'name'          => $this->name,
               'last_name'     => $this->last_name,
               'department_id' => $this->department_id,
               'state'         => $this->state,
           ]);
           $this->cancel();
           $this->emit('refreshLivewireDatatable');
           //session()->flash('success', 'Usuario actualizado');

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
        $this->document         = '';
        $this->department_id    = '';
        $this->password         = '';
        $this->state            = '';
        $this->view             = 'create';
        $this->hydrate();
    }

    public function errorNotUnique()
    {
       session()->flash('error', 'Error al editar el usuario.');
    }
}
