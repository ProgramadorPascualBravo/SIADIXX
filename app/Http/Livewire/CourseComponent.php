<?php

namespace App\Http\Livewire;

use App\Course;
use App\Department;
use App\Program;
use Livewire\Component;
use Livewire\WithPagination;

class CourseComponent extends Component
{
    use WithPagination;

    public $view = 'create';

    public $course_id, $name, $codigo, $program_id, $moodle_id, $state;

    public function render()
    {
        return view('livewire.course.course-component',
            [
                'courses'    => Course::orderBy('id', 'desc')->paginate(2),
                'programs'   => Program::all()
            ]
        );
    }

    public function store()
    {
        $this->validate([
            'name'              => 'required',
            'codigo'            => 'required|unique:courses,codigo',
            'program_id'        => 'required|exists:programs,id',
            'moodle_id'         => 'required|numeric',
            'state'             => 'required|numeric'
        ]);

        $course = new Course();

        $course->create([
            'name'              => $this->name,
            'codigo'            => $this->codigo,
            'program_id'        => $this->program_id,
            'moodle_id'         => $this->moodle_id,
            'state'             => $this->state
        ]);

        session()->flash('success', 'Nuevo curso creado.');

    }

    public function edit($id)
    {
        $course             = Course::find($id);
        $this->course_id    = $course->id;
        $this->name         = $course->name;
        $this->codigo       = $course->codigo;
        $this->program_id   = $course->program_id;
        $this->moodle_id    = $course->moodle_id;
        $this->state        = $course->state;
        $this->view         = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name'              => 'required',
            'codigo'            => 'required|exists:courses,codigo',
            'program_id'        => 'required|exists:programs,id',
            'moodle_id'         => 'required|numeric',
            'state'             => 'required|numeric'
        ]);

        $course = Course::find($this->course_id);

        $course->update([
            'name'              => $this->name,
            'codigo'            => $this->codigo,
            'program_id'        => $this->program_id,
            'moodle_id'         => $this->moodle_id,
            'state'             => $this->state
        ]);

        session()->flash('success', 'Curso actualizado');
        $this->cancel();
    }

    public function change_state($id)
    {
        $course =           Course::find($id);
        $course->state =    !$course->state;
        $course->save();
        session()->flash('success', 'Acción realizada.');

    }

    public function cancel()
    {
        $this->course_id    = '';
        $this->name         = '';
        $this->codigo       = '';
        $this->state        = '';
        $this->program_id   = '';
        $this->moodle_id    = '';
        $this->view         = 'create';
        $this->hydrate();
    }

    private function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
