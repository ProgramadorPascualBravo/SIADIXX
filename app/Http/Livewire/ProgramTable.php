<?php

namespace App\Http\Livewire;

use App\Department;
use App\Program;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ProgramTable extends LivewireDatatable
{
    public $model    = Program::class;

   public $hideable = 'select';

   public $exportable = true;


   protected $listeners = ['refreshLivewireDatatable'];


   public function columns() : array
   {
        $columns =  [
           Column::name('name')->label('Nombre Programa')->editable()->filterable()->searchable(),
           Column::name('faculty')->label('Facultad')->editable()->filterable()->searchable(),
           BooleanColumn::name('state')->label('Estado')->filterable()->hide(),
           Column::name('department.name')->filterable(
              $this->department->pluck('name')
           )->label('Categoria'),
           Column::callback(['id'], function ($id){
              return view('fragments.link-to', ['route' => 'program-detail', 'params' => ['id' => $id], 'name' => 'Ver', 'btn' => 'btn-blue']);
           })->label('Detalle')->alignRight(),
        ];

        if (Auth::user()->can('program_write')) {
             array_push($columns, Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignRight());
        }
        if (Auth::user()->can('program_destroy')){
             array_push($columns, Column::delete()->label('Eliminar')->alignRight()->hide());
        }

        return $columns;
   }

   public function edit($id)
   {
      $this->emit('edit', $id);
   }

   public function getDepartmentProperty()
   {
      return Department::all('name');
   }
}