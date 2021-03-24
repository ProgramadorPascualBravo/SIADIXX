<?php

namespace App\Http\Livewire;

use App\Course;
use App\Program;
use App\Traits\ClearErrorsLivewireComponent;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CourseComponent extends Component
{
    use WithPagination, ClearErrorsLivewireComponent;

    public $view = 'create';

    public $course_id, $name, $code, $program_id, $state;

   protected $listeners = ['errorNotUnique', 'edit'];

   public function render()
    {
        return view('livewire.course.course-component',
            [
                'programs'   => Program::all()
            ]
        );
    }

    public function store()
    {
        $this->validate([
            'name'              => 'required',
            'code'              => 'required|unique:courses,code',
            'program_id'        => 'required|exists:programs,id',
            'state'             => 'required|numeric'
        ]);

        $course = new Course();

        $course->create([
            'name'              => $this->name,
            'code'              => $this->code,
            'program_id'        => $this->program_id,
            'state'             => $this->state
        ]);

        session()->flash('success', 'Nuevo curso creado.');

    }

    public function edit($id)
    {
        $course             = Course::find($id);
        $this->course_id    = $course->id;
        $this->name         = $course->name;
        $this->code         = $course->code;
        $this->program_id   = $course->program_id;
        $this->state        = $course->state;
        $this->view         = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name'              => 'required',
            'code'              => 'required|exists:courses,code',
            'program_id'        => 'required|exists:programs,id',
            'state'             => 'required|numeric'
        ]);

        try  {

           $course = Course::find($this->course_id);

           $course->update([
               'name'              => $this->name,
               'code'              => $this->code,
               'program_id'        => $this->program_id,
               'state'             => $this->state
           ]);

           session()->flash('success', 'Curso actualizado');
           $this->cancel();
           $this->emit('refreshLivewireDatatable');
        } catch (QueryException $queryException) {
           $this->errorNotUnique();
        }
    }

    public function change_state($id)
    {
        $course         =   Course::find($id);
        $course->state  =   !$course->state;
        $course->save();
        session()->flash('success', 'Acción realizada.');

    }

    public function cancel()
    {
        $this->course_id    = '';
        $this->name         = '';
        $this->code         = '';
        $this->state        = '';
        $this->program_id   = '';
        $this->moodle_id    = '';
        $this->view         = 'create';
        $this->hydrate();
    }

   public function errorNotUnique()
   {
      session()->flash('error', 'Error al editar la materia.');
   }

}
