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
           Column::name('name')->label(__('modules.program.name'))->editable()->filterable()->searchable(),
           Column::name('code')->label(__('modules.input.code'))->editable()->filterable()->searchable(),
           Column::name('faculty')->label(__('modules.input.faculty'))->editable()->filterable()->searchable(),
           BooleanColumn::name('state')->label(__('modules.input.state'))->filterable()->hide(),
           Column::name('department.name')->filterable(
              $this->department->pluck('name')
           )->label(__('modules.category.name')),
           NumberColumn::name('courses.id:count')->label('# Asignaturas')->filterable()->alignCenter(),
           Column::callback(['id'], function ($id){
              return view('fragments.link-to', ['route' => 'program-detail', 'params' => ['id' => $id], 'name' => 'Ver', 'btn' => 'btn-blue']);
           })->label(__('modules.table.detail'))->alignCenter(),
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