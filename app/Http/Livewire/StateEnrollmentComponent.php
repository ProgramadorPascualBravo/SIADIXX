<?php


namespace App\Http\Livewire;


use App\RolMoodle;
use App\StateEnrollment;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class StateEnrollmentComponent extends Component
{
   use ClearErrorsLivewireComponent, WithPagination, FlashMessageLivewaire;

   public $view = 'create';

   public $id_state_enrollment, $name, $state, $delete_moodle;

   protected $listeners = ['edit', 'showAlert'];

   public function render()
   {
      return view('livewire.state-enrollment.state-enrollment-component');
   }

   public function store()
   {
      $this->validate([
         'name'            => 'required|unique:state_enrollments,name',
         'delete_moodle'   => 'required',
         'state'           => 'required'
      ]);

      try {


         $state_enrollment = new StateEnrollment();

         $state_enrollment->create([
            'name'            => trim($this->name),
            'delete_moodle'   => $this->delete_moodle,
            'state'           => $this->state
         ]);
         $this->cancel();
         $this->refreshTable();
         $this->showAlert('alert-success', __('messages.success.create'));
      }catch (QueryException $queryException) {
         $this->showAlert('alert-error', __('messages.errors.create'));
      }

   }


   public function edit($id)
   {
      $state_enrollment          = StateEnrollment::find($id);
      $this->id_state_enrollment = $state_enrollment->id;
      $this->name                = $state_enrollment->name;
      $this->delete_moodle       = $state_enrollment->delete_moodle;
      $this->state               = $state_enrollment->state;
      $this->view                = 'edit';
   }

   public function update()
   {
      $this->validate([
         'name'            => 'required',
         'delete_moodle'   => 'required',
         'state'           => 'required'
      ]);

      try {

         $state_enrollment = StateEnrollment::findOrFail($this->id_state_enrollment);
         $state_enrollment->update([
            'name'            => trim($this->name),
            'delete_moodle'   => trim($this->delete_moodle),
            'state'           => trim($this->state)
         ]);
         $this->cancel();
         $this->refreshTable();
         $this->showAlert('alert-success', __('messages.success.update'));
      } catch (QueryException $queryException) {
         $this->showAlert('alert-error', __('messages.errors.update'));
      }
   }

   public function cancel()
   {
      $this->id_state_enrollment    = '';
      $this->name                   = '';
      $this->delete_moodle          = '';
      $this->state                  = '';
      $this->view                   = 'create';
      $this->hydrate();
   }

}