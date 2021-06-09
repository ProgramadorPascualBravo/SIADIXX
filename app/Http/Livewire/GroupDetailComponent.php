<?php

namespace App\Http\Livewire;


use App\Group;
use Livewire\Component;

/**
 * Libreria https://laravel-livewire.com/docs/2.x/quickstart
 * Class GroupDetailComponent
 * @package App\Http\Livewire
 */
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