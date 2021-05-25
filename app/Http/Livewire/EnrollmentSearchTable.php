<?php


namespace App\Http\Livewire;


use App\Enrollment;
use App\Group;
use App\RolMoodle;
use App\Traits\SetParamsTable;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class EnrollmentSearchTable extends LivewireDatatable
{
   use SetParamsTable;

   public $model       = Enrollment::class;
   public $exportable  = true;
   protected $state    = [
      'Desmatriculado',
      'Matrículado',
      'Cancelada',
      'Finalizada',
      'Retirado'
   ];

   protected $listeners = ['setNewDate'];

   public function builder()
   {
      return $this->model::query()
         ->where('enrollments.email', 'like', "%$this->params%")
         ->orWhere('enrollments.code', 'like', "%$this->params%")
         ->orWhere('enrollments.period', 'like', "%$this->params%")
         ->orWhere('enrollments.state', 'like', "%$this->params%")
         ->orWhere('enrollments.rol', 'like', "%$this->params%");
   }
   public function columns()
   {
      $columns = [
         Column::name('code')->label('Código Grupo')->filterable(
            $this->groups->pluck('code')
         )->searchable()->alignRight(),
         Column::name('email')->label('Email')->filterable()->searchable(),
         Column::name('rol')->label('Rol')->filterable(
            $this->roles->pluck('name')
         )->searchable()->alignRight(),
         Column::name('period')->label('Periodo')->filterable()->searchable()->alignRight(),
         Column::name('state')->label('Estado')->filterable(
            $this->state
         )->alignRight(),
         DateColumn::name('created_at')->label('Fecha creación')->filterable()->alignRight(),
      ];

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
}