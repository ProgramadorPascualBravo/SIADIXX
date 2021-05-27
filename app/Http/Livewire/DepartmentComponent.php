<?php

namespace App\Http\Livewire;

use App\Department;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentComponent extends Component
{
    use ClearErrorsLivewireComponent, WithPagination, FlashMessageLivewaire;

    public $view = 'create';

    public $name, $department_id, $state, $process;

    protected $listeners = ['edit'];

    public function render()
    {
        return view('livewire.department.department-component');
    }

    public function store()
    {
        $this->validate([
           'name'    => 'required|unique:departments,name',
           'state'   => 'required'
        ]);
        try  {

           $this->process     = true;
           $department = new Department();

           $department->create([
              'name'          => $this->name
           ]);

           $this->cancel();
           $this->process    = false;
           $this->refreshTable();
           $this->showAlert('alert-success', __('messages.success.create'));
        } catch (QueryException $queryException) {
           $this->process    = false;
           $this->showAlert('alert-error', __('messages.error.create'));
        }
    }


    public function edit($id)
    {
        $department             = Department::find($id);
        $this->name             = $department->name;
        $this->department_id    = $department->id;
        $this->state            = $department->state;
        $this->view             = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name'          => 'required',
            'state'         => 'required'
        ]);
       try {
            $this->process   = true;
            $department = Department::findOrFail($this->department_id);
            $department->update([
               'name'        => $this->name,
               'state'       => $this->state
            ]);

            $this->cancel();
            $this->process    = false;
            $this->refreshTable();
            $this->showAlert('alert-success', __('messages.success.update'));
       } catch (QueryException $queryException) {
            $this->process    = false;
            $this->showAlert('alert-error', __('messages.error.update'));
       }
    }

    public function cancel()
    {
        $this->department_id    = '';
        $this->name             = '';
        $this->view             = 'create';
        $this->hydrate();
    }

}
