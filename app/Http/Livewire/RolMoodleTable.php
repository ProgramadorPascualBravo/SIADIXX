<?php

namespace App\Http\Livewire;

use App\RolMoodle;
use App\Traits\DeleteMassive;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class RolMoodleTable extends LivewireDatatable
{

   use DeleteMassive;

   public $model = RolMoodle::class;
   public $hideable = 'select';
   public $exportable = true;

   public $relation     = 'role_moodle';


   protected $listeners = ['refreshLivewireDatatable'];

   public $beforeTableSlot = 'fragments.delete-massive';

   public function builder()
   {
        return $this->model::query();
   }

    public function columns()
    {
        $columns = [
           Column::checkbox(),
           Column::name('name')->label(__('modules.input.name'))->editable()->searchable()->truncate(),
           BooleanColumn::name('state')->label(__('modules.input.state'))->filterable()->alignCenter(),
           DateColumn::name('created_at')->label(__('modules.table.created'))->filterable(),
        ];
        if (Auth::user()->can('role_moodle_write')) {
          array_push($columns, Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignCenter());
        }
        if (Auth::user()->can('role_moodle_destroy')){
          array_push($columns, Column::delete()->label('Eliminar')->alignCenter()->hide());
        }
        return $columns;
    }

   public function edit($id)
   {
      $this->emit('edit', $id);
   }
}