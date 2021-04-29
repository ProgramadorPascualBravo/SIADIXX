<?php

namespace App\Http\Livewire;

use App\RolMoodle;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class RolMoodleTable extends LivewireDatatable
{
   public $model = RolMoodle::class;
   public $hideable = 'select';
   public $exportable = true;

   protected $listeners = ['refreshLivewireDatatable'];

   public function builder()
   {
        return $this->model::query();
   }

    public function columns()
    {
        return [
           NumberColumn::callback(['id'], function ($id){
              return $id;
           })->label('id'),
           Column::name('name')->label('Nombre')->editable()->searchable()->truncate(),
           BooleanColumn::name('state')->label('Estado')->filterable(),
           DateColumn::name('created_at')->label('Fecha creación')->filterable(),
           Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignRight(),
           Column::delete()->label('Eliminar')->alignRight()->hide()
        ];
    }

   public function edit($id)
   {
      $this->emit('edit', $id);
   }
}