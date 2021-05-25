<?php


namespace App\Http\Livewire;


use App\Course;
use App\Group;
use App\Traits\SetParamsTable;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class GroupSearchTable extends LivewireDatatable
{
   use SetParamsTable;

   public $model        = Group::class;

   public $exportable   = true;

   protected $listeners = ['setNewDate'];

   public function builder()
   {
      return $this->model::query()
         ->where('groups.name', 'like', "%$this->params%")
         ->orWhere('groups.code', 'like', "%$this->params%");
   }

   public function columns() : array
   {
      $columns = [
         Column::name('code')->label('Codigo')->searchable()->filterable(),
         Column::callback(['name', 'course.name'], function ($name, $course_name){
            return "Grupo: {$name} de {$course_name}";
         })->label('Grupo')->searchable()->filterable(),
         BooleanColumn::name('state')->label('Estado')->filterable()->hide(),
         Column::name('course.name')->filterable(
            $this->courses->pluck('name')
         )->label('Asignatura'),
         NumberColumn::name('enrollments.id:count')->label('# de Matrículas')->filterable()->alignCenter(),
         DateColumn::name('created_at')->label('Fecha creación')->filterable(),
         Column::callback(['id'], function ($id){
            return view('fragments.link-to', ['route' => 'group-detail', 'params' => ['id' => $id], 'name' => "Ver", 'btn' => 'btn-blue']);
         })->label('Detalle del grupo')->alignRight(),
      ];
      return $columns;
   }

   public function getCoursesProperty()
   {
      return Course::all('name');
   }
}