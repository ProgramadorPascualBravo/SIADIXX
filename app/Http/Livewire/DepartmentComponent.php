<?php

namespace App\Http\Livewire;

use App\Department;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentComponent extends Component
{
    use WithPagination;

    public $view = 'create';

    public $name, $department_id, $state;

    public function render()
    {
        return view('livewire.department.department-component', [
            'departments' => Department::orderBy('id', 'desc')->paginate(2)
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $department = new Department();

        $department->create([
           'name' => $this->name
        ]);
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

        $department = Department::find($this->department_id);
        $department->update([
            'name'          => $this->name,
            'state'         => $this->state
        ]);
        $this->cancel();
    }

    public function destroy($id)
    {
        session()->flash('success', 'Departamento eliminado.');
        Department::destroy($id);
    }

    public function change_state($id)
    {
        $department =           Department::find($id);
        $department->state =    !$department->state;
        $department->save();
        session()->flash('success', 'Acción realizada.');

    }

    private function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cancel()
    {
        $this->department_id    = '';
        $this->name             = '';
        $this->view             = 'create';
        $this->hydrate();
    }
}
