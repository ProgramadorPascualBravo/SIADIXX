<?php

namespace App\Http\Livewire;

use App\Department;
use App\Program;
use App\Traits\DeleteMassive;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ProgramTable extends LivewireDatatable
{

    use DeleteMassive;

    public $model        = Program::class;

    public $hideable     = 'select';

    public $exportable   = true;

    public $beforeTableSlot = 'fragments.delete-massive';

    public $relation     = 'program';

    protected $listeners = ['refreshLivewireDatatable'];


    public function columns() : array
    {
        $relation = $this->relation;
        $columns =  [
           Column::checkbox('id'),
           Column::name('name')->label('Nombre Programa')->editable()->filterable()->searchable(),
           Column::name('code')->label('Código')->editable()->filterable()->searchable(),
           Column::name('faculty')->label('Facultad')->editable()->filterable()->searchable(),
           BooleanColumn::name('state')->label('Estado')->filterable()->hide(),
           Column::name('department.name')->filterable(
              $this->department->pluck('name')
           )->label('Categoria'),
           NumberColumn::name('courses.id:count')->label('# Asignaturas')->filterable()->alignCenter(),
           Column::callback(['id'], function ($id){
              return view('fragments.link-to', ['route' => 'program-detail', 'params' => ['id' => $id], 'name' => 'Ver', 'btn' => 'btn-blue']);
           })->label('Detalle')->alignCenter(),
        ];

        if (Auth::user()->can('program_write')) {
             array_push($columns, Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignCenter());
        }
        if (Auth::user()->can('program_destroy')){
           array_push($columns, Column::callback(['id', 'name'], function ($id) use ($relation){
              return view('fragments.btn-action-delete', [
                 'value' => $id, 'relation' => $relation
              ]);
           })->label('Eliminar')->alignCenter()->hide());
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