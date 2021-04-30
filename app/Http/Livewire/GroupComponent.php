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

    public $name, $code, $course_id, $state, $period, $group_id;

   protected $listeners = ['errorNotUnique', 'edit'];

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
            'period'    => 'required',
            'state'     => 'required'
        ]);
        try {

           $course = Course::findOrFail($this->course_id);

           $course->groups()->create([
               'name'      => $this->name,
               'code'      => $course->code . $this->name,
               'period'    => $this->period
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
        $group              = Group::find($id);

        $this->group_id     = $group->id;
        $this->name         = $group->name;
        $this->period       = $group->period;
        $this->course_id    = $group->course_id;
        $this->state        = $group->state;
        $this->view         = 'edit';

    }

    public function update()
    {
        $this->validate([
            'name'      => 'required',
            'course_id' => 'required|exists:courses,id',
            'period'    => 'required',
            'state'     => 'required'
        ]);

        try {

           $group          = Group::findOrFail($this->group_id);
           $course         = Course::findOrFail($this->course_id);
           //TODO Validar si tiene matrículas

           $group->update([
               'name'      => $this->name,
               'code'      => $course->code . $this->name,
               'course_id' => $course->id,
               'period'    => $this->period,
               'state'     => $this->state
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
        $this->group_id     = '';
        $this->state        = '';
        $this->code         = '';
        $this->name         = '';
        $this->course_id    = '';
        $this->period       = '';
        $this->view         = 'create';
        $this->hydrate();

    }

}
