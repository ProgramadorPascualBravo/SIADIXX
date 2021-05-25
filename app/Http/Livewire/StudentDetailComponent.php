<?php


namespace App\Http\Livewire;


use App\Student;
use App\StudentDBMoodle;
use Livewire\Component;

class StudentDetailComponent extends Component
{
   public $enrollments, $student;

   function mount(Student $student)
   {
      $this->student = $student;
      $this->enrollments = $this->student->enrollments;
   }

   function render()
   {
      return view('livewire.student.details-component');
   }
}