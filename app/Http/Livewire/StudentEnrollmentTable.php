<?php


namespace App\Http\Livewire;


use App\Enrollment;
use App\RolMoodle;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

/**
 * Libreria https://github.com/mediconesystems/livewire-datatables
 * Class StudentEnrollmentTable
 * @package App\Http\Livewire
 */

class StudentEnrollmentTable extends LivewireDatatable
{
   public $model = Enrollment::class;
   public $hideable     = 'select';

   public $exportable   = true;

   protected $listeners = ['refreshLivewireDatatable'];
   protected $state    = [
      'Desmatriculado',
      'Matrículado',
      'Cancelada',
      'Finalizada',
      'Retirado'
   ];

   public function builder()
   {
      return $this->model::query()->where('email', $this->params);
   }

   public function columns()
   {
      $columns = [
         Column::callback(['group.course.name', 'group.course.id'], function ($name, $id){
            return view('fragments.link-to-name', ['route' => 'course-detail', 'params' => ['id' => $id], 'name' => $name]);
         })->label(__('modules.course.name'))->searchable(),
         Column::callback(['group.name', 'group.id'], function ($name, $id){
            return view('fragments.link-to-name', ['route' => 'group-detail', 'params' => ['id' => $id], 'name' => $name]);
         })->label(__('modules.group.name'))->searchable()->alignCenter(),
         Column::name('rol')->filterable(
            $this->roles->pluck('name')
         )->label('Rol matrícula'),
         Column::name('state')->filterable(
            $this->state
         )->label(__('modules.input.state')),
         DateColumn::name('created_at')->filterable()->label(__('modules.table.created')),
      ];

      return $columns;
   }

   public function getRolesProperty()
   {
      return RolMoodle::all('name');
   }


}