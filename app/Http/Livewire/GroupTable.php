<?php

namespace App\Http\Livewire;

use App\Course;
use App\Enrollment;
use App\Group;
use App\Traits\DeleteMassive;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class GroupTable extends LivewireDatatable
{
    use DeleteMassive;

    public $model       = Group::class;
    public $hideable    = 'select';
    public $exportable  = true;

    public $beforeTableSlot = 'fragments.delete-massive';

    public $relation     = 'group';

    protected $listeners = ['refreshLivewireDatatable'];

    public function builder()
    {
        return $this->model::query();
    }

    public function columns()
    {
        $relation = $this->relation;
        $columns =  [
           Column::checkbox(),
           Column::name('code')->label('Codigo')->searchable()->filterable(),
           Column::callback(['name', 'course.name'], function ($name, $course_name){
              return "Grupo: {$name} de {$course_name}";
           })->label('Grupo')->searchable()->filterable(),
           BooleanColumn::name('state')->label('Estado')->filterable()->hide(),
           Column::name('course.name')->filterable(
              $this->courses->pluck('name')
           )->label('Asignatura'),
           NumberColumn::callback(['code', 'name'], function ($code) {
              return Enrollment::where(['code' => $code, 'state' => 'Matrículado'])->get()->count();
           })->label('# Matrículas Activas')->filterable()->alignCenter(),
           DateColumn::name('created_at')->label('Fecha creación')->filterable()->hide(),
           Column::callback(['id'], function ($id){
              return view('fragments.link-to', ['route' => 'group-detail', 'params' => ['id' => $id], 'name' => "Ver", 'btn' => 'btn-blue']);
           })->label('Detalle del grupo')->alignCenter(),

        ];
        if (Auth::user()->can('group_write')) {
           array_push($columns, Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignCenter());
           array_push($columns, Column::callback(['code'], function ($code){
              return view('livewire.datatables.close', ['value' => $code]);
           })->label('Cerrar Matrículas')->alignCenter());

        }
        if (Auth::user()->can('group_destroy')){
           array_push($columns, Column::callback(['id', 'name'], function ($id) use ($relation){
              return view('fragments.btn-action-delete', [
                 'value' => $id, 'relation' => $relation
              ]);
           })->label('Eliminar')->alignCenter()->hide());
        }

       return $columns;
    }

   public function getCoursesProperty()
   {
      return Course::all('name');
   }

   public function edit($id)
   {
      $this->emit('edit', $id);
   }
   public function close($code)
   {
      try {
         Enrollment::where('code', $code)
                  ->where('state', 'Matrículado')
                  ->update([
                     'state' => 'Finalizada'
                  ]);
         $this->emit('showAlert', 'alert-success', 'Operación realizada!');
      } catch (QueryException $queryException) {
         $this->emit('showAlert', ['alert-error', $queryException->getMessage()]);;
      }
   }
}