<?php


namespace App\Http\Livewire;


use App\Course;
use App\Program;
use App\Traits\SetParamsTable;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class CourseSearchTable extends LivewireDatatable
{
   use SetParamsTable;

   public $model           = Course::class;

   public $exportable      = true;

   protected $listeners    = ['setNewDate'];

   public function builder()
   {
      return $this->model::query()
         ->where('name', 'like', "%$this->params%")
         ->orWhere('code', 'like', "%$this->params%");
   }

   public function columns() : array
   {
      $columns = [
         Column::name('code')->label('Código')->filterable()->searchable(),
         Column::name('name')->label('Nombre Materia')->filterable()->searchable(),
         BooleanColumn::name('state')->label('Estado')->filterable()->alignCenter(),
         NumberColumn::name('groups.id:count')->label('# de Grupos')->filterable()->alignCenter(),
         DateColumn::name('created_at')->label('Fecha creación')->filterable(),
         Column::callback(['id'], function ($id){
            return view('fragments.link-to', ['route' => 'course-detail', 'params' => ['id' => $id], 'name' => 'Ver', 'btn' => 'btn-blue']);
         })->label('Detalle')->alignCenter(),
      ];
      return $columns;
   }

}