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

   public $id_enrollment, $code, $rol, $email, $state, $period, $process;

   protected $listeners = ['edit', 'showAlert'];

   public $states_badget     = [
      'Desmatriculado',
      'Matrículado',
      'Cancelada',
      'Finalizada',
      'Retirado'
   ];

   public function render()
   {
      return view('livewire.enrollment.enrollment-component', [
         'groups' => Group::where('state', 1)->get(),
         'roles' => RolMoodle::where('state', 1)->select('name')->get()
      ]);
   }
   public function store()
   {
      $this->validate([
         'code'              => 'required|exists:groups,code|unique_with:enrollments,email,period',
         'email'             => 'required|exists:students,email,state,1',
         'rol'               => 'required|exists:roles_moodle,name',
         'state'             => 'required',
         'period'            => 'required'
      ]);
      try {

         $this->process         = true;
         $enrollment = new Enrollment();

         $enrollment->create([
            'email'             => trim($this->email),
            'code'              => trim($this->code),
            'rol'               => trim($this->rol),
            'state'             => $this->state,
            'period'            => trim($this->period)
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
      $enrollment          = Enrollment::find($id);
      $this->id_enrollment = $enrollment->id;
      $this->email         = $enrollment->email;
      $this->code          = $enrollment->code;
      $this->rol           = $enrollment->rol;
      $this->state         = $enrollment->state;
      $this->period        = $enrollment->period;
      $this->view          = 'edit';
   }

   public function update()
   {
      $this->validate([
         'code'              => 'required|exists:groups,code',
         'email'             => 'required|exists:students,email',
         'rol'               => 'required|exists:roles_moodle,name',
         'state'             => 'required',
         'period'            => 'required'
      ]);

      try  {

         $this->process      = true;

         $enrollment = Enrollment::find($this->id_enrollment);

         $enrollment->update([
            'email'          => trim($this->email),
            'code'           => trim($this->code),
            'rol'            => trim($this->rol),
            'state'          => $this->state,
            'period'         => trim($this->period)
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
      $this->id_enrollment    = '';
      $this->email            = '';
      $this->code             = '';
      $this->rol              = '';
      $this->state            = '';
      $this->period           = '';
      $this->view             = 'create';
      $this->hydrate();
   }

}