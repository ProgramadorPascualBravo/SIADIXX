<?php

namespace App\Http\Livewire;

use App\Course;
use App\Program;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class CourseTable extends LivewireDatatable
{
    public $model       = Course::class;
    public $hideable    = 'select';
    public $exportable  = true;

    protected $listeners = ['refreshLivewireDatatable'];

    public function columns()
    {
        $columns = [
           Column::name('code')->label('Código')->filterable()->searchable(),
           Column::name('name')->label('Nombre Materia')->editable()->filterable()->searchable(),
           BooleanColumn::name('state')->label('Estado')->filterable(),
           Column::name('program.name')->filterable(
              $this->programs->pluck('name')
           )->label('Programa'),
           DateColumn::name('created_at')->label('Fecha creación')->filterable(),
           Column::callback(['id'], function ($id){
              return view('fragments.link-to', ['route' => 'course-detail', 'params' => ['id' => $id], 'name' => 'Ver', 'btn' => 'btn-blue']);
           })->label('Detalle'),
        ];
          if (Auth::user()->can('course_write')) {
             array_push($columns, Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignRight());
          }
          if (Auth::user()->can('course_destroy')){
             array_push($columns, Column::delete()->label('Eliminar')->alignRight()->hide());
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