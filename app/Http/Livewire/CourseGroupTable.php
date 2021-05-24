<?php


namespace App\Http\Livewire;


use App\Course;
use App\Enrollment;
use App\Group;
use App\Program;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class CourseGroupTable extends LivewireDatatable
{
   public $model = Group::class;
   public $hideable     = 'select';

   public $exportable   = true;

   public function builder()
   {
      return $this->model::query()->where('course_id', $this->params);
   }

   public function columns() : array
   {
      $columns = [
         Column::name('name')->label('Nombre')->searchable()->filterable(),
         Column::name('code')->label('Código')->searchable()->filterable(),
         BooleanColumn::name('state')->filterable()->label('Estado'),
         DateColumn::name('created_at')->filterable()->label('Fecha creación'),
         Column::callback(['id'], function ($id){
            return view('fragments.link-to', ['route' => 'group-detail', 'params' => ['id' => $id], 'name' => 'Ver', 'btn' => 'btn-blue']);
         })->label('Detalle'),
      ];

      return $columns;
   }
}