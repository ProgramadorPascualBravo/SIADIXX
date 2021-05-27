<?php

namespace App\Http\Livewire;

use App\Department;
use App\Program;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class ProgramComponent extends Component
{

    use WithPagination, ClearErrorsLivewireComponent, FlashMessageLivewaire;

    public $view = 'create';

    public $program_id, $name, $department_id, $state, $faculty, $process;

    protected $listeners = ['edit'];

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
            'state'             => 'required'
        ]);

        try {

           $this->process          = true;

           $program = new Program();

           $program->create([
               'name'              => $this->name,
               'state'             => $this->state,
               'department_id'     => $this->department_id,
               'faculty'           => $this->faculty
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
           $this->process      = true;
           $program = Program::findOrFail($this->program_id);
           $program->update([
              'name'           => $this->name,
              'department_id'  => $this->department_id,
              'faculty'        => $this->faculty,
              'state'          => $this->state,
           ]);
           $this->cancel();
           $this->process    = false;
           $this->refreshTable();
           $this->showAlert('alert-success', __('messages.success.update'));
        } catch (QueryException $queryException) {
           $this->process    = false;
           $this->showAlert('alert-error', __('messages.error.update'));        }
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

}
