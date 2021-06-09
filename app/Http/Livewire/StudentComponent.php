<?php


namespace App\Http\Livewire;


use App\Department;
use App\Interfaces\ModuleComponent;
use App\Student;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Libreria https://laravel-livewire.com/docs/2.x/quickstart
 * Class StudentComponent
 * @package App\Http\Livewire
 */
class StudentComponent extends Component implements ModuleComponent
{
   use WithPagination, ClearErrorsLivewireComponent, FlashMessageLivewaire;

   public $view = 'create';

   public $user_id, $name, $last_name, $email, $document, $state, $block, $process = false, $enrollment = 0;

   protected $listeners = ['edit', 'showAlert'];

   public function render()
   {
      return view('livewire.student.student-component', [
         'departments'   => Department::all()
      ]);
   }

   public function store()
   {
      $this->validate([
         'name'          => 'required',
         'last_name'     => 'required',
         'email'         => 'required|email:rfc|unique:students,email|unique_with:students,document',
         'document'      => 'required|unique:students,document|numeric',
         'state'         => 'required',
      ]);
      try {
         $this->process    = true;
         $student = new Student();

         $student->create([
            'name'          => trim($this->name),
            'last_name'     => trim($this->last_name),
            'email'         => trim($this->email),
            'document'      => trim($this->document),
            'password'      => md5(trim($this->document)),
            'state'         => trim($this->state)

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
      $student             = Student::find($id);
      $this->user_id       = $student->id;
      $this->name          = $student->name;
      $this->last_name     = $student->last_name;
      $this->email         = $student->email;
      $this->document      = $student->document;
      $this->state         = $student->state;
      $this->enrollment    = $student->enrollments->count();
      $this->view          = 'edit';

   }

   public function update()
   {
      $this->validate([
         'name'          => 'required',
         'last_name'     => 'required',
         'email'         => 'required|email:rfc',
         'document'      => 'required',
         'state'         => 'required',
      ]);

      try {
         $student = Student::findOrFail($this->user_id);
         $student->update([
            'name'          => trim($this->name),
            'last_name'     => trim($this->last_name),
            'email'         => trim($this->email),
            'document'      => trim($this->document),
            'state'         => trim($this->state),
         ]);
         $this->cancel();
         $this->refreshTable();
         $this->showAlert('alert-success', __('messages.success.update'));
      } catch (QueryException $queryException) {
         $this->showAlert('alert-error', __('messages.errors.update'));
         //$this->showAlert('alert-error', $queryException->getMessage());
      }

   }

   public function cancel()
   {
      $this->user_id       = '';
      $this->name          = '';
      $this->last_name     = '';
      $this->email         = '';
      $this->document      = '';
      $this->state         = '';
      $this->view          = 'create';
      $this->hydrate();
   }

}