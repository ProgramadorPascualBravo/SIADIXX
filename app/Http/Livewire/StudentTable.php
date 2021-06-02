<?php

namespace App\Http\Livewire;

use App\Student;
use App\Traits\DeleteMassive;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class StudentTable extends LivewireDatatable
{

    use DeleteMassive;

    public $model = Student::class;

    public $hideable = 'select';

    public $exportable = true;

    public $beforeTableSlot = 'fragments.delete-massive';

    public $relation     = 'student';

    protected $listeners = ['refreshLivewireDatatable'];

    public function builder()
    {
        return $this->model::query();
    }

    public function columns()
    {
        $relation = $this->relation;
        $columns = [
            Column::checkbox(),
            Column::name('name')->label('Nombres')->editable()->filterable()->searchable(),
            Column::name('last_name')->label('Apellidos')->filterable()->searchable()->editable(),
            Column::name('email')->label('Email')->filterable()->searchable(),
            Column::name('document')->label('Documento')->filterable()->searchable(),
            BooleanColumn::name('state')->label('Estado')->filterable()->hide(),
            NumberColumn::name('enrollments.id:count')->label('# Matríciulas')->filterable()->alignCenter(),
            DateColumn::name('created_at')->label('Fecha creación')->filterable(),
            Column::callback(['id'], function ($id){
               return view('fragments.link-to', ['route' => 'moodle-detail', 'params' => ['id' => $id]]);
            })->label('Detalle')->alignCenter(),
            Column::callback(['id', 'name'], function ($id){
              return view('fragments.btn-action-reset-password', ['action' => 'reset', 'value' => $id, 'name' => 'Reiniciar']);
            })->label('Reiniciar Contraseña')->alignCenter(),
        ];
        if (Auth::user()->can('moodle_write')) {
           array_push($columns, Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignCenter());
        }
        if (Auth::user()->can('moodle_destroy')){
           array_push($columns, Column::callback(['id', 'document'], function ($id) use ($relation){
              return view('fragments.btn-action-delete', [
                 'value' => $id, 'relation' => $relation
              ]);
           })->label('Eliminar')->alignCenter()->hide());
        }

        return $columns;
    }

    public function refreshLivewireDatatable()
    {
       parent::refreshLivewireDatatable(); // TODO: Change the autogenerated stub
    }

   public function reset_password($id)
   {
      try {
         $student             = Student::find($id);
         $student->password   = md5($student->document);
         if ($student->save()) {
            $this->emit('showAlert', 'alert-success', __('messages.success.update'));
         } else {
            $this->emit('showAlert', 'alert-error', __('messages.error.update'));
         }
      } catch (QueryException $exception) {
         $this->emit('showAlert', 'alert-error', __('messages.error.update'));
      }
   }


   public function edit($id)
   {
       $this->emit('edit', $id);
   }

}