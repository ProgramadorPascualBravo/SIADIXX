<?php

namespace App\Http\Livewire;

use App\Course;
use App\Group;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class GroupComponent extends Component
{

    use WithPagination, ClearErrorsLivewireComponent, FlashMessageLivewaire;


    public $view = 'create';

    public $name, $code, $course_id, $state, $group_id, $process;

   protected $listeners = ['errorNotUnique', 'edit', 'showAlert'];

   public function render()
    {
        return view('livewire.group.group-component', [
            'courses'   => Course::all()
        ]);
    }

    public function store()
    {
        $this->validate([
            'name'      => 'required',
            'course_id' => 'required|exists:courses,id',
            'state'     => 'required'
        ]);
        try {

            $this->process = true;
            $course = Course::findOrFail($this->course_id);

            $course->groups()->create([
               'name'      => trim($this->name),
               'code'      => trim($course->code . $this->name),
               'short_name'=> trim($course->code . $this->name),
               'state'     => $this->state
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
        $group              = Group::find($id);

        $this->group_id     = $group->id;
        $this->name         = $group->name;
        $this->course_id    = $group->course_id;
        $this->state        = $group->state;
        $this->view         = 'edit';

    }

    public function update()
    {
        $this->validate([
            'name'      => 'required',
            'course_id' => 'required|exists:courses,id',
        ]);

        try {
           $this->process  = true;
           $group          = Group::findOrFail($this->group_id);
           $course         = Course::findOrFail($this->course_id);

           $group->update([
               'name'      => trim($this->name),
               'code'      => trim($course->code . $this->name),
               'course_id' => trim($course->id),
               'short_name'=> trim($course->code . $this->name),
               'state'     => $this->state

           ]);

           $this->cancel();
           $this->process    = false;
           $this->refreshTable();
           $this->showAlert('alert-success', __('messages.success.update'));
        } catch (QueryException $queryException) {
           $this->process    = false;
           $this->showAlert('alert-error', __('messages.error.update'));
        }
    }

    public function cancel()
    {
        $this->group_id     = '';
        $this->state        = '';
        $this->code         = '';
        $this->name         = '';
        $this->course_id    = '';
        $this->view         = 'create';
        $this->hydrate();

    }

}
