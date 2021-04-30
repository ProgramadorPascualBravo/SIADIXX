<?php


namespace App\Http\Livewire;


use App\Department;
use App\Student;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\FlashMessageLivewaire;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class StudentComponent extends Component
{
   use WithPagination, ClearErrorsLivewireComponent, FlashMessageLivewaire;

   public $view = 'create';

   public $user_id, $name, $last_name, $email, $document, $state, $block;

   protected $listeners = ['edit'];

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
         'document'      => 'required|unique:students,document',
         'state'         => 'required',
      ]);
      try {

         $student = new Student();

         $student->create([
            'name'          => $this->name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'document'      => $this->document,
            'password'      => md5($this->document),
            'state'         => $this->state

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
      $student             = Student::find($id);
      $this->user_id       = $student->id;
      $this->name          = $student->name;
      $this->last_name     = $student->last_name;
      $this->email         = $student->email;
      $this->document      = $student->document;
      $this->state         = $student->state;
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
            'name'          => $this->name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'document'      => $this->document,
            'state'         => $this->state,
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
      $this->user_id       = '';
      $this->name          = '';
      $this->last_name     = '';
      $this->email         = '';
      $this->document      = '';
      $this->view          = 'create';
      $this->hydrate();
   }

}