<?php

namespace App\Http\Livewire;

use App\Enrollment;
use App\Group;
use App\RolMoodle;
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
        return [
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
           Column::name('state')->label('Estado')->filterable(
              $this->state
           ),
           DateColumn::name('created_at')->label('Fecha creación')->filterable(),
           Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignRight(),
           Column::delete()->label('Eliminar')->alignRight()->hide()
        ];
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