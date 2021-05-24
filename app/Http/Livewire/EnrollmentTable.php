<?php

namespace App\Http\Livewire;

use App\Enrollment;
use App\Group;
use App\RolMoodle;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class EnrollmentTable extends LivewireDatatable
{
    public $model       = Enrollment::class;
    public $hideable    = 'select';
    public $exportable  = true;
    protected $state    = [
         'Desmatriculado',
         'Matrículado',
         'Cancelada',
         'Finalizada',
         'Retirado'
    ];

    protected $listeners = ['refreshLivewireDatatable'];

    public function builder()
    {
        return $this->model::query();
    }

    public function columns()
    {
        $columns = [
           NumberColumn::callback(['id'], function ($id){
              return $id;
           })->label('id'),
           Column::name('code')->label('Código Grupo')->filterable(
              $this->groups->pluck('code')
           )->searchable(),
           Column::name('email')->label('Email')->filterable()->searchable(),
           Column::name('rol')->label('Rol')->filterable(
              $this->roles->pluck('name')
           )->searchable(),
           Column::name('period')->label('Periodo')->filterable()->searchable(),
           Column::name('state')->label('Estado')->filterable(
              $this->state
           ),
           DateColumn::name('created_at')->label('Fecha creación')->filterable(),
        ];
        if (Auth::user()->can('enrollment_write')) {
          array_push($columns, Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignRight());
        }
        if (Auth::user()->can('enrollment_destroy')){
          array_push($columns, Column::delete()->label('Eliminar')->alignRight()->hide());
        }

        return $columns;
    }

   public function getGroupsProperty()
   {
      return Group::all('code');
   }

   public function getRolesProperty()
   {
      return RolMoodle::all('name');
   }

   public function edit($id)
   {
      $this->emit('edit', $id);
   }
}