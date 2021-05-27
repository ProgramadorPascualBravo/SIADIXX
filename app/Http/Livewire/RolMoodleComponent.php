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

   public $id_rol_moodle, $name, $state, $process;

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

         $this->process = true;

         $rolMoodle = new RolMoodle();

         $rolMoodle->create([
            'name' => trim($this->name)
         ]);
         $this->cancel();
         $this->process    = false;
         $this->refreshTable();
         $this->showAlert('alert-success', __('messages.success.create'));
      }catch (QueryException $queryException) {
         $this->process    = false;
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
         $this->process   = true;
         $rolMoodle = RolMoodle::findOrFail($this->department_id);
         $rolMoodle->update([
            'name'        => trim($this->name),
            'state'       => trim($this->state)
         ]);
         $this->cancel();
         $this->process    = false;
         $this->refreshTable();
         $this->showAlert('alert-success', __('messages.success.update'));
      } catch (QueryException $queryException) {
         $this->process    = false;
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