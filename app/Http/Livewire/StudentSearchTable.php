<?php


namespace App\Http\Livewire;


use App\Student;
use App\Traits\SetParamsTable;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class StudentSearchTable extends LivewireDatatable
{
   use SetParamsTable;

   public $model = Student::class;

   public $exportable = true;

   protected $listeners = ['refreshLivewireDatatable', 'setNewDate'];

   public function builder()
   {
      return $this->model::query()
         ->where('name', 'like', "%$this->params%")
         ->orWhere('last_name', 'like', "%$this->params%")
         ->orWhere('email', 'like', "%$this->params%")
         ->orWhere('document', 'like', "%$this->params%");
   }

   public function columns()
   {
      $columns = [
         Column::name('name')->label('Nombres')->filterable()->searchable(),
         Column::name('last_name')->label('Apellidos')->filterable()->searchable()->editable(),
         Column::name('email')->label('Email')->filterable()->searchable(),
         Column::name('document')->label('Documento')->filterable()->searchable(),
         BooleanColumn::name('state')->label('Estado')->filterable()->alignCenter(),
         DateColumn::name('created_at')->label('Fecha creación')->filterable(),
         Column::callback(['id'], function ($id){
            return view('fragments.link-to', ['route' => 'student-detail', 'params' => ['id' => $id], 'name' => 'Ver']);
         })->label('Detalle')->alignRight(),
      ];
      return $columns;
   }

}