<?php


namespace App\Http\Livewire;


use App\Course;
use App\Enrollment;
use App\Group;
use App\RolMoodle;
use App\Traits\ClearErrorsLivewireComponent;
use Illuminate\Database\QueryException;
use Livewire\Component;

class EnrollmentComponent extends Component
{
   use ClearErrorsLivewireComponent;

   public $view = 'create';

   public $id_enrollment, $code, $rol, $email, $state;
   protected $listeners = ['errorNotUnique', 'edit'];

   public function render()
   {
      return view('livewire.enrollment.enrollment-component', [
         'groups' => Group::all(['code', 'name']),
         'roles' => RolMoodle::all(['name'])
      ]);
   }
   public function store()
   {
      $this->validate([
         'code'              => 'required|exists:groups,code',
         'email'             => 'required|exists:students,email',
         'rol'               => 'required|exists:roles_moodle,name',
         'state'             => 'required|numeric'
      ]);

      $enrollment = new Enrollment();

      $enrollment->create([
         'email'             => $this->email,
         'code'              => $this->code,
         'rol'               => $this->rol,
         'state'             => $this->state
      ]);

      session()->flash('success', 'Nueva matrícula creado.');

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
         'state'             => 'required|numeric'
      ]);

      try  {

         $enrollment = Enrollment::find($this->id_enrollment);

         $enrollment->update([
            'email'             => $this->email,
            'code'              => $this->code,
            'rol'               => $this->rol,
            'state'             => $this->state
         ]);

         session()->flash('success', 'Matrícula actualizada');
         $this->cancel();
         $this->emit('refreshLivewireDatatable');
      } catch (QueryException $queryException) {
         $this->errorNotUnique();
      }
   }

   public function change_state($id)
   {
      $enrollment         =   Enrollment::find($id);
      $enrollment->state  =   !$enrollment->state;
      $enrollment->save();
      session()->flash('success', 'Acción realizada.');

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

   public function errorNotUnique()
   {
      session()->flash('error', 'Error al editar la materia.');
   }
}