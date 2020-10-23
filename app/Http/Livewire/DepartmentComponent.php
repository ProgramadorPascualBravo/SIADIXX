<?php

namespace App\Http\Livewire;

use App\Departament;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentComponent extends Component
{
    use WithPagination;

    public $view = 'create';

    public $name, $departament_id;

    public function render()
    {
        return view('livewire.department.department-component', [
            'departaments' => Departament::orderBy('id', 'desc')->paginate(2)
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required'
        ]);

        $departament = new Departament();

        $departament->create([
           'name' => $this->name
        ]);
        session()->flash('success', 'Departamento creado.');
    }


    public function edit($id)
    {
        $departament            = Departament::find($id);
        $this->name             = $departament->name;
        $this->departament_id   = $departament->id;
        $this->view             = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name'          => 'required'
        ]);

        $departament = Departament::find($this->departament_id);
        $departament->update([
            'name'          => $this->name,
        ]);
        $this->cancel();
    }

    public function destroy($id)
    {
        session()->flash('success', 'Departamento eliminado.');
        Departament::destroy($id);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cancel()
    {
        $this->departament_id   = '';
        $this->name             = '';
        $this->view             = 'create';
        $this->hydrate();
    }
}
