<?php
namespace App\Http\Livewire;


use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionComponent extends Component
{
   use WithPagination, FlashMessageLivewaire, ClearErrorsLivewireComponent;

   public $view = 'create';

   public $listeners = ['edit', 'assign'];

   public $permission_id, $name, $rol_id;

   public function render()
   {;
      return view('livewire.permission-rol.permission-component', [
         'roles' => Role::all(),
         'permissions' => Permission::all()
      ]);
   }

   public function store()
   {
      $this->validate([
         'name' => 'required'
      ]);
      try {
         Permission::create([
            'name' => $this->name
         ]);
         $this->refreshTable();
         $this->showAlert('alert-success', __('messages.success.create'));
      } catch (QueryException $exception) {
         $this->showAlert('alert-success', __('messages.errors.create'));
      }
   }
   public function update()
   {
      $permission = Permission::findById($this->role_id);
      try {

         $this->validate([
            'name' => 'required'
         ]);

         $permission->update([
            'name' => trim($this->name)
         ]);
         $this->refreshTable();
         $this->cancel();
         $this->showAlert('alert-success', __('messages.success.update'));
      } catch (QueryException $queryException) {
         $this->showAlert('alert-error', __('messages.errors.update'));
      }
   }

   public function assign($permissions)
   {
      $this->validate([
         'rol_id' => 'required'
      ]);

      $rol  = Role::find($this->rol_id);
      $rol->syncPermissions($permissions);

   }

   public function edit($id)
   {
      $permission = Permission::findById($id);

      $this->permission_id    = $permission->id;
      $this->name             = $permission->name;
      $this->view             = 'edit';
   }

   public function change()
   {
      $this->emit('refreshTableCustom', $this->rol_id);
   }
}