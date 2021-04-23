<?php


namespace App\Http\Livewire;


use App\Department;
use App\Student;
use App\Traits\ClearErrorsLivewireComponent;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class StudentComponent extends Component
{
   use WithPagination, ClearErrorsLivewireComponent;

   public $view = 'create';

   public $user_id, $name, $last_name, $email, $document, $state, $block;

   protected $listeners = ['errorNotUnique', 'edit'];

   public function render()
   {
      return view('livewire.student.student-component', [
         'departments'   => Department::all()
      ]);
   }

   public function destroy($id)
   {
      session()->flash('success', 'Usuario eliminado.');
      User::destroy($id);
   }

   public function store()
   {
      $this->validate([
         'name'          => 'required',
         'last_name'     => 'required',
         'email'         => 'required|email:rfc|unique:students,email',
         'document'      => 'required|unique:students,document',
         'state'         => 'required',
      ]);
      try {

         $student                = new Student();
         $student->name          = $this->name;
         $student->last_name     = $this->last_name;
         $student->email         = $this->email;
         //$user->department_id    = $this->department_id;
         $student->password      = md5($this->document);
         $student->state         = $this->state;
         $student->save();
         $this->cancel();
         $this->emit('refreshLivewireDatatable');
         session()->flash('success', 'Usuario creado.');
      } catch (QueryException $queryException) {
         $this->errorNotUnique();
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
      //$user->department_id    = $this->department_id;
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
         //'department_id' => 'required|exists:departments,id',
         'state'         => 'required',
   ]);

      $student = Student::find($this->user_id);
      try {

         $student->update([
            'name'          => $this->name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'document'      => $this->document,
            'state'         => $this->state,
         ]);
         $this->cancel();
         $this->emit('refreshLivewireDatatable');
         session()->flash('success', 'Usuario actualizado');
      } catch (QueryException $queryException) {
         $this->errorNotUnique();
      }

   }

   public function change_state($id)
   {
      $student =         Student::find($id);
      $student->state =  !$student->state;
      $student->save();
      session()->flash('success', 'Acción realizada.');

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

   public function errorNotUnique()
   {
      session()->flash('error', 'Error al editar el usuario.');
   }
}