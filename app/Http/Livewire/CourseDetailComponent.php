<?php


namespace App\Http\Livewire;


use App\Course;
use Livewire\Component;

class CourseDetailComponent extends Component
{
   public $course;

   public function mount($course)
   {
      $this->course  = $course;
   }

   public function render()
   {
      return view('livewire.course.details-component');
   }
}