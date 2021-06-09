<?php


namespace App\Http\Livewire;


use App\Program;
use Livewire\Component;

/**
 * Libreria https://laravel-livewire.com/docs/2.x/quickstart
 * Class ProgramDetailComponent
 * @package App\Http\Livewire
 */
class ProgramDetailComponent extends Component
{
   public $program;

   public function mount($program)
   {
      $this->program = $program;
   }

   public function render()
   {
      return view('livewire.program.details-component');
   }
}