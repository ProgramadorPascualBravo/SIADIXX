<?php

namespace App\Http\Livewire;


use App\Group;
use Livewire\Component;

class GroupDetailComponent extends Component
{
   public $group;

   public function mount($id)
   {
      $this->group = Group::find($id);
   }

   public function render()
   {
      return view ('livewire.group.details-component');
   }
}