<?php


namespace App\Http\Livewire;


use App\Course;
use App\Enrollment;
use App\Group;
use App\RolMoodle;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class EnrollmentComponent extends Component
{
   use ClearErrorsLivewireComponent, WithPagination, FlashMessageLivewaire;

   public $view = 'create';

   public $id_enrollment, $code, $rol, $email, $state;
   protected $listeners = ['edit'];

   public function render()
   {
      return view('livewire.enrollment.enrollment-component', [
         'groups' => Group::all(),
         'roles' => RolMoodle::all(['name'])
      ]);
   }
   public function store()
   {
      $this->validate([
         'code'              => 'required|exists:groups,code|unique_with:enrollments,email',
         'email'             => 'required|exists:students,email',
         'rol'               => 'required|exists:roles_moodle,name',
         'state'             => 'required'
      ]);
      try {

         $enrollment = new Enrollment();

         $enrollment->create([
            'email'             => $this->email,
            'code'              => $this->code,
            'rol'               => $this->rol,
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
      $enrollment          = Enrollment::find($id);
      $this->id_enrollment = $enrollment->id;
      $this->email         = $enrollment->email;
      $this->code          = $enrollment->code;
      $this->rol           = $enrollment->rol;
      $this->state         = $enrollment->state;
      $this->view          = 'edit';
   }

   public function update()
   {
      $this->validate([
         'code'              => 'required|exists:groups,code',
         'email'             => 'required|exists:students,email',
         'rol'               => 'required|exists:roles_moodle,name',
         'state'             => 'required'
      ]);

      try  {

         $enrollment = Enrollment::find($this->id_enrollment);

         $enrollment->update([
            'email'             => $this->email,
            'code'              => $this->code,
            'rol'               => $this->rol,
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
      $this->id_enrollment    = '';
      $this->email            = '';
      $this->code             = '';
      $this->rol              = '';
      $this->state            = '';
      $this->view             = 'create';
      $this->hydrate();
   }

}