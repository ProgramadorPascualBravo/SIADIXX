<?php


namespace App\Http\Livewire;


use App\Enrollment;
use App\RolMoodle;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

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
            return view('fragments.link-to', ['route' => 'course-detail', 'params' => ['id' => $id], 'name' => $name]);
         })->label('Asignatura')->searchable(),
         Column::callback(['group.name', 'group.id'], function ($name, $id){
            return view('fragments.link-to', ['route' => 'group-detail', 'params' => ['id' => $id], 'name' => $name]);
         })->label('Grupo')->searchable()->alignCenter(),
         Column::name('rol')->filterable(
            $this->roles->pluck('name')
         ),
         Column::name('state')->filterable(
            $this->state
         )->label('Estado'),
         DateColumn::name('created_at')->filterable()->label('Fecha creación'),
      ];

      return $columns;
   }

   public function getRolesProperty()
   {
      return RolMoodle::all('name');
   }


}