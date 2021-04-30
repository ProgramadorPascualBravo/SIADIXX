<?php


namespace App\Http\Livewire;


use App\RolMoodle;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class RolMoodleComponent extends Component
{
   use ClearErrorsLivewireComponent, WithPagination, FlashMessageLivewaire;

   public $view = 'create';

   public $id_rol_moodle, $name, $state;

   protected $listeners = ['edit'];

   public function render()
   {
      return view('livewire.rol_moodle.rol-moodle-component');
   }

   public function store()
   {
      $this->validate([
         'name'      => 'required|unique:roles_moodle,name',
         'state'     => 'required'
      ]);

      try {

         $rolMoodle = new RolMoodle();

         $rolMoodle->create([
            'name' => $this->name
         ]);
         $this->cancel();
         $this->refreshTable();
         $this->showAlert('alert-success', __('messages.success.create'));
      }catch (QueryException $queryException) {
         $this->showAlert('alert-error', __('messages.error.create'));
      }

   }


   public function edit($id)
   {
      $rolMoodle             = RolMoodle::find($id);
      $this->name             = $rolMoodle->name;
      $this->id_rol_moodle    = $rolMoodle->id;
      $this->state            = $rolMoodle->state;
      $this->view             = 'edit';
   }

   public function update()
   {
      $this->validate([
         'name'          => 'required',
         'state'         => 'required'
      ]);
      try {
         $rolMoodle = RolMoodle::findOrFail($this->department_id);
         $rolMoodle->update([
            'name'        => $this->name,
            'state'       => $this->state
         ]);
         $this->cancel();
         $this->refreshTable();
         $this->showAlert('alert-success', __('messages.success.update'));
      } catch (QueryException $queryException) {
         $this->showAlert('alert-error', __('messages.error.update'));
      }
   }

   public function cancel()
   {
      $this->id_rol_moodle    = '';
      $this->name             = '';
      $this->view             = 'create';
      $this->hydrate();
   }

}