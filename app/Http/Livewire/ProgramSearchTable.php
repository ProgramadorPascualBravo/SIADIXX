<?php


namespace App\Http\Livewire;


use App\Department;
use App\Program;
use App\Traits\SetParamsTable;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ProgramSearchTable extends LivewireDatatable
{
   use SetParamsTable;

   public $model        = Program::class;

   public $exportable   = true;

   protected $listeners = ['setNewDate'];

   public function builder()
   {
      return $this->model::query()
         ->where('name', 'like', "%$this->params%")
         ->orWhere('faculty', 'like', "%$this->params%");
   }

   public function columns() : array
   {
      $columns = [
         Column::name('name')->label('Nombre Programa')->filterable()->searchable(),
         Column::name('faculty')->label('Facultad')->filterable()->searchable(),
         BooleanColumn::name('state')->label('Estado')->filterable(),
         NumberColumn::name('courses.id:count')->label('# de Asignaturas')->filterable()->alignCenter(),
         Column::callback(['id'], function ($id){
            return view('fragments.link-to', ['route' => 'program-detail', 'params' => ['id' => $id], 'name' => 'Ver', 'btn' => 'btn-blue']);
         })->label('Detalle')->alignRight(),
      ];
      return $columns;
   }

   public function getDepartmentProperty()
   {
      return Department::all('name');
   }
}