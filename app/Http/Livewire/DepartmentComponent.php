<?php

namespace App\Http\Livewire;

use App\Department;
use App\Traits\ClearErrorsLivewireComponent;
use Illuminate\Database\QueryException;
use Livewire\Component;

class DepartmentComponent extends Component
{
    use ClearErrorsLivewireComponent;

    public $view = 'create';

    public $name, $department_id, $state;

    protected $listeners = ['errorNotUnique', 'edit'];

    public function render()
    {
        return view('livewire.department.department-component');
    }

    public function store()
    {
        $this->validate([
           'name' => 'required|unique:departments,name'
        ]);

        $department = new Department();

        $department->create([
           'name' => $this->name
        ]);

        $this->emit('refreshLivewireDatatable');

        session()->flash('success', 'Departamento creado.');
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
            $department = Department::find($this->department_id);
            $department->update([
               'name'        => $this->name,
               'state'       => $this->state
            ]);
            $this->cancel();
            $this->emit('refreshLivewireDatatable');
            session()->flash('success', 'Departamento actualizado.');
       } catch (QueryException $queryException) {
            $this->errorNotUnique();
       }
    }

    public function change_state($id)
    {
        $department =           Department::find($id);
        $department->state =    !$department->state;
        $department->save();
        session()->flash('success', 'Acción realizada.');

    }

    public function cancel()
    {
        $this->department_id    = '';
        $this->name             = '';
        $this->view             = 'create';
        $this->hydrate();
    }

    public function errorNotUnique()
    {
       session()->flash('error', 'Error al editar el departamento.');
    }
}
