<?php

namespace App\Http\Livewire;

use App\Course;
use App\Program;
use App\Traits\ClearErrorsLivewireComponent;
use Livewire\Component;
use Livewire\WithPagination;

class CourseComponent extends Component
{
    use WithPagination, ClearErrorsLivewireComponent;

    public $view = 'create';

    public $course_id, $name, $code, $program_id, $moodle_id, $state;

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
            'code'              => 'required|unique:courses,code',
            'program_id'        => 'required|exists:programs,id',
            'moodle_id'         => 'required|numeric',
            'state'             => 'required|numeric'
        ]);

        $course = new Course();

        $course->create([
            'name'              => $this->name,
            'code'              => $this->code,
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
        $this->code         = $course->code;
        $this->program_id   = $course->program_id;
        $this->moodle_id    = $course->moodle_id;
        $this->state        = $course->state;
        $this->view         = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name'              => 'required',
            'code'              => 'required|exists:courses,code',
            'program_id'        => 'required|exists:programs,id',
            'moodle_id'         => 'required|numeric',
            'state'             => 'required|numeric'
        ]);

        $course = Course::find($this->course_id);

        $course->update([
            'name'              => $this->name,
            'code'              => $this->code,
            'program_id'        => $this->program_id,
            'moodle_id'         => $this->moodle_id,
            'state'             => $this->state
        ]);

        session()->flash('success', 'Curso actualizado');
        $this->cancel();
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

}
