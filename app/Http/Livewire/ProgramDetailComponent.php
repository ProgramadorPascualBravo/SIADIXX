<?php


namespace App\Http\Livewire;


use App\Program;
use Livewire\Component;

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