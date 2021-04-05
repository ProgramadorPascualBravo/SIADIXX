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

   public $user_id, $name, $last_name, $email, $document, $country, $department, $city, $address, $telephone, $cellphone, $state, $block;

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
         $student->password      = Hash::make($this->document);
         $student->document      = $this->document;
         $student->country       = $this->country;
         $student->department    = $this->department;
         $student->city          = $this->city;
         $student->address       = $this->address;
         $student->telephone     = $this->telephone;
         $student->cellphone     = $this->cellphone;
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
      //$user->department_id    = $this->department_id;
      $this->document      = $student->document;
      $this->country       = $student->country;
      $this->department    = $student->department;
      $this->city          = $student->city;
      $this->address       = $student->address;
      $this->telephone     = $student->telephone;
      $this->cellphone     = $student->cellphone;
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
            'country'       => $this->country,
            'department'    => $this->department,
            'city'          => $this->city,
            'address'       => $this->address,
            'telephone'     => $this->telephone,
            'cellphone'     => $this->cellphone,
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
      $this->country       = '';
      $this->department    = '';
      $this->city          = '';
      $this->address       = '';
      $this->telephone     = '';
      $this->cellphone     = '';
      $this->view          = 'create';
      $this->hydrate();
   }

   public function errorNotUnique()
   {
      session()->flash('error', 'Error al editar el usuario.');
   }
}