<?php


namespace App\Http\Livewire;


use App\Student;
use App\StudentDBMoodle;
use Livewire\Component;

class StudentDetailComponent extends Component
{
   public $enrollments, $student;

   function mount($id)
   {
      $this->student = Student::find($id);
      $this->enrollments = $this->student->enrollments;
   }

   function render()
   {
      return view('livewire.student.details-component');
   }
}