<?php

namespace App\Http\Livewire;


use App\Group;
use Livewire\Component;

class GroupDetailComponent extends Component
{
   public $group;

   public function mount($group)
   {
      $this->group = $group;
   }

   public function render()
   {
      return view ('livewire.group.details-component');
   }
}