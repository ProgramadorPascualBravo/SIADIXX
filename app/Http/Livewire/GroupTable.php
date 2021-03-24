<?php

namespace App\Http\Livewire;

use App\Course;
use App\Group;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
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
           Column::name('code')->label('Código')->filterable()->searchable(),
           Column::name('name')->label('Grupo')->editable()->filterable()->searchable(),
           BooleanColumn::name('state')->label('Estado')->filterable()->hide(),
           Column::name('course.name')->filterable(
              $this->courses->pluck('name')
           )->label('Materia'),
           Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignRight()->hide(),
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