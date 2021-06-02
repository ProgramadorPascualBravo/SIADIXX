<?php


namespace App\Http\Livewire;


use App\User;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Spatie\Permission\Models\Role;

class RoleTable extends LivewireDatatable
{
   public $model = Role::class;

   public $search = false, $user_id;

   public $title = "Asignar Rol";

   protected $listeners = ['refreshLivewireDatatable', 'refreshTableCustom'];

   public function builder()
   {
      if (!is_null($this->user_id) and !empty($this->user_id)) {
         $this->selected = User::find($this->user_id)->getRoleNames()->toArray();
         $this->user_id = null;
      }
      return $this->model::query();
   }

   public function columns()
   {
      $columns = [
         Column::name('name')->filterable()->label('Rol'),
         Column::callback(['name'], function ($name){
            return User::role($name)->count();
         })->label('Cantidad de usuarios')->filterable(),
         Column::checkbox('name')->label('Asignar'),
      ];
      if (Auth::user()->can('role_write')) {
         array_push($columns, Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignRight());
      }
      if (Auth::user()->can('role_destroy')){
         array_push($columns, Column::delete()->label('Eliminar')->alignRight()->hide());
      }

      return $columns;
   }

   public function edit($id)
   {
      $this->emit('edit', $id);
   }

   public function assign()
   {
      $this->emit('assign', $this->selected);
   }

   public function refreshTableCustom($user_id)
   {
      $this->user_id = $user_id;
      parent::refreshLivewireDatatable(); // TODO: Change the autogenerated stub
   }
}