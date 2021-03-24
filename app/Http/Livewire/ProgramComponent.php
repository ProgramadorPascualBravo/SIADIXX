<?php

namespace App\Http\Livewire;

use App\Department;
use App\Program;
use App\Traits\ClearErrorsLivewireComponent;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class ProgramComponent extends Component
{

    use WithPagination;
    use ClearErrorsLivewireComponent;

    public $view = 'create';

    public $program_id, $name, $department_id, $state, $faculty;

    protected $listeners = ['errorNotUnique', 'edit'];

    public function render()
    {
        return view('livewire.program.program-component', [
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
            'state'             => 'required'
        ]);

        try {
           $program = Program::find($this->program_id);
           $program->update([
              'name'           => $this->name,
              'department_id'  => $this->department_id,
              'faculty'        => $this->faculty,
              'state'          => $this->state,
           ]);
           $this->cancel();
           $this->emit('refreshLivewireDatatable');
           session()->flash('success', 'Programa actualizado');
        } catch (QueryException $queryException) {
           $this->errorNotUnique();
        }
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

    public function errorNotUnique()
    {
       session()->flash('error', 'Error al editar el usuario.');
    }

}
