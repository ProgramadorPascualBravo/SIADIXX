<?php

namespace App\Http\Livewire;

use App\Course;
use App\Program;
use App\Traits\DeleteMassive;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class CourseTable extends LivewireDatatable
{
   use DeleteMassive;
   public $model        = Course::class;
   public $hideable     = 'select';
   public $exportable   = true;

   public $relation     = 'course';

   protected $listeners = ['refreshLivewireDatatable'];

   public $beforeTableSlot = 'fragments.delete-massive';

   public function columns()
   {
      $relation = $this->relation;
      $columns = [
         Column::checkbox(),
         Column::name('code')->label(__('modules.input.code'))->filterable()->searchable(),
         Column::name('name')->label(__('modules.input.name'))->editable()->filterable()->searchable(),
         BooleanColumn::name('state')->label(__('modules.input.state'))->filterable(),
         Column::name('program.name')->filterable(
            $this->programs->pluck('name')
         )->label('Programa'),
         NumberColumn::name('groups.id:count')->label('# Grupos')->filterable()->alignCenter(),
         DateColumn::name('created_at')->label(__('modules.table.created'))->filterable()->hide(),
         Column::callback(['id'], function ($id){
            return view('fragments.link-to', ['route' => 'course-detail', 'params' => ['id' => $id], 'name' => 'Ver', 'btn' => 'btn-blue']);
         })->label(__('modules.table.detail')),
      ];
      if (Auth::user()->can('course_write')) {
         array_push($columns, Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignRight());
      }
      if (Auth::user()->can('course_destroy')){
         array_push($columns, Column::callback(['id', 'name'], function ($id) use ($relation){
            return view('fragments.btn-action-delete', [
               'value' => $id, 'relation' => $relation
            ]);
         })->label('Eliminar')->alignCenter()->hide());
      }

      return $columns;
   }

   public function getProgramsProperty()
   {
      return Program::all('name');
   }

   public function edit($id)
   {
      $this->emit('edit', $id);
   }
}