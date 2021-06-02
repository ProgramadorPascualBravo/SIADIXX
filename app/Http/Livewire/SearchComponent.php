<?php


namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithPagination;

class SearchComponent extends Component
{
   use WithPagination;

   public $view = '';

   public $search, $search_table = '', $process = false;

   public $listeners = ['clear', 'stopClear'];

   public function render()
   {
      return view('livewire.search.search-component');
   }

   public function change($view)
   {
      $this->clear();
      $this->view       = $view;
   }

   public function search()
   {
      $this->process      = true;
      $this->search_table = $this->search;
      $this->validate([
         'search'    => 'required'
      ]);
      $this->emit('setNewDate', $this->search_table);
   }

   public function clear()
   {
      $this->search        = '';
      $this->search_table  = '';
   }

   public function stopClear()
   {
      $this->process       = false;
   }
}