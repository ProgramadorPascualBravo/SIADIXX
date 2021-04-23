<?php


namespace App\Http\Livewire;


use App\RolMoodle;
use App\Traits\ClearErrorsLivewireComponent;
use Illuminate\Database\QueryException;
use Livewire\Component;

class RolMoodleComponent extends Component
{
   use ClearErrorsLivewireComponent;

   public $view = 'create';

   public $id_rol_moodle, $name, $state;

   protected $listeners = ['errorNotUnique', 'edit'];

   public function render()
   {
      return view('livewire.rol_moodle.rol-moodle-component');
   }

   public function store()
   {
      $this->validate([
         'name' => 'required|unique:roles_moodle,name'
      ]);

      $rolMoodle = new RolMoodle();

      $rolMoodle->create([
         'name' => $this->name
      ]);

      $this->emit('refreshLivewireDatatable');

      session()->flash('success', 'Rol creado.');
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
         $rolMoodle = RolMoodle::find($this->department_id);
         $rolMoodle->update([
            'name'        => $this->name,
            'state'       => $this->state
         ]);
         $this->cancel();
         $this->emit('refreshLivewireDatatable');
         session()->flash('success', 'Rol actualizado.');
      } catch (QueryException $queryException) {
         $this->errorNotUnique();
      }
   }

   public function change_state($id)
   {
      $rolMoodle =           RolMoodle::find($id);
      $rolMoodle->state =    !$rolMoodle->state;
      $rolMoodle->save();
      session()->flash('success', 'Acción realizada.');

   }

   public function cancel()
   {
      $this->id_rol_moodle    = '';
      $this->name             = '';
      $this->view             = 'create';
      $this->hydrate();
   }

   public function errorNotUnique()
   {
      session()->flash('error', 'Error al editar el rol.');
   }
}