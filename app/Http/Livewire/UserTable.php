<?php


namespace App\Http\Livewire;


use App\User;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class UserTable extends LivewireDatatable
{
   public $model        = User::class;

   public $hideable     = 'select';

   public $exportable   = true;

   protected $listeners = ['refreshLivewireDatatable'];


   public function builder()
   {
      //TODO Datos según departamento
      return $this->model::query()->where('users.department_id', Auth::user()->department_id); // TODO: Change the autogenerated stub
   }

   public function columns() : array
   {
      return [
         NumberColumn::callback(['id'], function ($id){
            return $id;
         })->label('id'),
         Column::name('name')->label('Nombres')->filterable()->searchable()->editable(),
         Column::name('last_name')->label('Apellidos')->filterable()->searchable()->editable(),
         Column::name('username')->label('Email')->filterable()->searchable(),
         BooleanColumn::name('state')->label('Estado')->filterable()->hide(),
         BooleanColumn::name('verified')->label('Verificado')->filterable()->hide(),
         Column::name('department.name')->filterable()->label('Departamento'),
         DateColumn::name('created_at')->label('Fecha creación')->filterable(),
         Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignRight(),
         Column::delete()->label('Eliminar')->alignRight()->hide()
      ];
   }

   public function refreshLivewireDatatable()
   {
      parent::refreshLivewireDatatable(); // TODO: Change the autogenerated stub
   }

   public function edit($id)
   {
      $this->emit('edit', $id);
   }
}