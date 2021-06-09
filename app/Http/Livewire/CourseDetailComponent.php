<?php


namespace App\Http\Livewire;


use App\Course;
use Livewire\Component;

/**
 * Libreria https://laravel-livewire.com/docs/2.x/quickstart
 * Class CourseDetailComponent
 * @package App\Http\Livewire
 */
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