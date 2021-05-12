<?php

namespace App\Http\Livewire;

use App\Department;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use App\User;

class UserComponent extends Component
{
    use WithPagination, ClearErrorsLivewireComponent, FlashMessageLivewaire;

    public $view = 'create';

    public $user_id, $name, $last_name, $username, $document, $department_id, $state;

    protected $listeners = ['edit'];

    public function render()
    {
        return view('livewire.user.user-component', [
            'departments'   => Department::all()
        ]);
    }

    public function store()
    {

        $this->validate([
            'name'          => 'required',
            'last_name'     => 'required',
            'username'      => 'required|email:rfc|unique:users,username',
            'document'      => 'required|unique:users,document|numeric',
            'department_id' => 'required|exists:departments,id',
            'state'         => 'required'
        ]);
       try {
           $user                   = new User();
           $user->create([
               'name'            => trim($this->name),
               'last_name'       => trim($this->last_name),
               'username'        => trim($this->username),
               'document'        => trim($this->document),
               'department_id'   => trim($this->department_id),
               'password'        => Hash::make(trim($this->document)),
               'state'           => trim($this->state)
           ]);
           $this->cancel();
           $this->refreshTable();
           $this->showAlert('alert-success', __('messages.success.create'));
       } catch (QueryException $queryException) {
          $this->showAlert('alert-error', __('messages.error.create'));
       }

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
            'document'      => 'required|numeric',
            'department_id' => 'required',
            'state'         => 'required',
        ]);

        try {
           $user = User::findOrFail($this->user_id);
           $user->update([
               'name'          => trim($this->name),
               'last_name'     => trim($this->last_name),
               'department_id' => trim($this->department_id),
               'document'      => trim($this->document),
               'state'         => trim($this->state)
           ]);
           $this->cancel();
           $this->refreshTable();
           $this->showAlert('alert-success', __('messages.success.update'));

        } catch (QueryException $queryException) {
           $this->showAlert('alert-error', __('messages.error.update'));
        }

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

}
