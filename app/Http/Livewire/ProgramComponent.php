<?php

namespace App\Http\Livewire;

use App\Department;
use App\Program;
use Livewire\Component;
use Livewire\WithPagination;

class ProgramComponent extends Component
{

    use WithPagination;

    public $view = 'create';

    public $program_id, $name, $department_id, $state, $faculty;

    public function render()
    {
        return view('livewire.program.program-component', [
            'programs'      => Program::orderBy('id', 'desc')->paginate(2),
            'departments'   => Department::all()
        ]);
    }

    public function store()
    {
        $this->validate([
            'name'              => 'required',
            'department_id'     => 'required|exists:departments,id',
            'faculty'           => 'required',
            'state'             => 'required|numeric'
        ]);

        $program = new Program();

        $program->create([
            'name'              => $this->name,
            'state'             => $this->state,
            'department_id'     => $this->department_id,
            'faculty'           => $this->faculty
        ]);

        session()->flash('success', 'Nuevo programa creado.');
    }

    public function edit($id)
    {
        $program                = Program::find($id);
        $this->program_id       = $program->id;
        $this->department_id    = $program->department_id;
        $this->faculty          = $program->faculty;
        $this->name             = $program->name;
        $this->state            = $program->state;
        $this->view             = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name'              => 'required',
            'department_id'     => 'required|exists:departments,id',
            'faculty'           => 'required',
            'state'             => 'required|numeric'
        ]);

        $program = Program::find($this->program_id);
        $program->update([
           'name'           => $this->name,
           'department_id'  => $this->department_id,
           'faculty'        => $this->faculty,
           'state'          => $this->state,
        ]);

        session()->flash('success', 'Programa actualizado');
        $this->cancel();
    }

    public function cancel()
    {
        $this->program_id       = '';
        $this->name             = '';
        $this->state            = '';
        $this->faculty          = '';
        $this->department_id    = '';
        $this->view             = 'create';
        $this->hydrate();
    }

    public function change_state($id)
    {
        $program =          Program::find($id);
        $program->state =   !$program->state;
        $program->save();
        session()->flash('success', 'Acción realizada.');

    }

    private function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
