<?php

namespace App\Http\Livewire;

use App\Course;
use App\Program;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CourseComponent extends Component
{
    use WithPagination, ClearErrorsLivewireComponent, FlashMessageLivewaire;

    public $view = 'create';

    public $course_id, $name, $code, $program_id, $state;

   protected $listeners = ['edit'];

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
            'code'              => 'required|unique:courses,code|unique_with:courses,id',
            'program_id'        => 'required|exists:programs,id',
            'state'             => 'required|numeric'
        ]);
        try {

            $course = new Course();

            $course->create([
               'name'              => $this->name,
               'code'              => $this->code,
               'program_id'        => $this->program_id,
               'state'             => $this->state
            ]);

           $this->cancel();
           $this->refreshTable();
           $this->showAlert('alert-success', __('messages.success.create'));

        } catch (QueryException $queryException) {
           $this->showAlert('alert-error', __('messages.error.create'));
        }

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

           $course = Course::findOrFail($this->course_id);

           $course->update([
               'name'              => $this->name,
               'code'              => $this->code,
               'program_id'        => $this->program_id,
               'state'             => $this->state
           ]);

           $this->cancel();
           $this->refreshTable();
           $this->showAlert('alert-success', __('messages.success.update'));
        } catch (QueryException $queryException) {
           $this->showAlert('alert-error', __('messages.error.update'));
        }
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
