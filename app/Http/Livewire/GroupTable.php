<?php

namespace App\Http\Livewire;

use App\Course;
use App\Group;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class GroupTable extends LivewireDatatable
{
    public $model       = Group::class;
    public $hideable    = 'select';
    public $exportable  = true;

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
           Column::name('code')->label('Codigo')->searchable()->filterable(),
           Column::callback(['name', 'course.name'], function ($name, $course_name){
              return "Grupo: {$name} de {$course_name}";
           })->label('Grupo')->searchable()->filterable(),
           BooleanColumn::name('state')->label('Estado')->filterable()->hide(),
           Column::name('course.name')->filterable(
              $this->courses->pluck('name')
           )->label('Asignatura'),
           DateColumn::name('created_at')->label('Fecha creación')->filterable(),
           Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignRight(),
           Column::delete()->label('Eliminar')->alignRight()->hide()
        ];
    }

   public function getCoursesProperty()
   {
      return Course::all('name');
   }

   public function edit($id)
   {
      $this->emit('edit', $id);
   }
}