<?php

namespace App\Http\Livewire;

use App\Course;
use App\Group;
use App\Traits\ClearErrorsLivewireComponent;
use Livewire\Component;
use Livewire\WithPagination;

class GroupComponent extends Component
{

    use WithPagination, ClearErrorsLivewireComponent;


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

        $course = Course::find($this->course_id);

        $course->groups()->create([
            'name'      => $this->name,
            'code'      => $course->code . $this->name,
            'period'    => $this->period
        ]);
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

        $group          = Group::find($this->group_id);
        $course         = Course::find($this->course_id);
        //TODO Validar si tiene matrículas

        $group->update([
            'name'      => $this->name,
            'code'      => $course->code . $this->name,
            'course_id' => $course->id,
            'period'    => $this->period,
            'state'     => $this->state
        ]);

        $this->cancel();
    }

    public function change_state($id)
    {
        $group          =   Group::find($id);
        $group->state   =   !$group->state;
        $group->save();
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

   public function errorNotUnique()
   {
      session()->flash('error', 'Error al editar la materia.');
   }
}
