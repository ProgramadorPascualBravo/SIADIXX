<?php


namespace App\Http\Livewire;


use App\Enrollment;
use App\RolMoodle;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class GroupEnrollmentTable extends LivewireDatatable
{
   public $model = Enrollment::class;
   public $hideable     = 'select';

   public $exportable   = true;

   protected $state    = [
      'Desmatriculado',
      'Matrículado',
      'Cancelada',
      'Finalizada',
      'Retirado'
   ];

   public function builder()
   {
      return $this->model::query()->where('code', $this->params);
   }

   public function columns() : array
   {
      $columns = [
         Column::name('code')->label('Código')->searchable()->filterable(),
         Column::name('email')->label('Usuario')->searchable()->filterable(),
         Column::name('rol')->label('Rol')->filterable(
            $this->roles->pluck('name')
         )->searchable(),
         Column::name('state')->label('Estado')->filterable(
            $this->state
         ),
         Column::name('period')->label('Periodo')->filterable()->searchable(),
         DateColumn::name('created_at')->filterable()->label('Fecha creación'),
         Column::callback(['user.id'], function ($id){
            return view('fragments.link-to', ['route' => 'moodle-detail', 'params' => ['id' => $id], 'name' => 'Ver', 'btn' => 'btn-blue']);
         })->label('Detalle del usuario')->alignCenter(),
      ];

      return $columns;
   }

   public function getRolesProperty()
   {
      return RolMoodle::all('name');
   }
}