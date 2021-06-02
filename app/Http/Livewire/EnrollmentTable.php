<?php

namespace App\Http\Livewire;

use App\Enrollment;
use App\Group;
use App\RolMoodle;
use App\Traits\DeleteMassive;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class EnrollmentTable extends LivewireDatatable
{
    use DeleteMassive;
    public $model       = Enrollment::class;
    public $hideable    = 'select';
    public $exportable  = true;

    public $relation     = 'enrollment';

    protected $state    = [
         'Desmatriculado',
         'Matrículado',
         'Cancelada',
         'Finalizada',
         'Retirado'
    ];

    public $beforeTableSlot = 'fragments.delete-massive';

    protected $listeners = ['refreshLivewireDatatable'];

    public function builder()
    {
        return $this->model::query();
    }

    public function columns()
    {
        $relation = $this->relation;

        $columns = [
           Column::checkbox('id'),
           Column::name('code')->label(__('modules.input.code'))->filterable(
              $this->groups->pluck('code')
           )->searchable(),
           Column::name('email')->label(__('modules.input.email'))->filterable()->searchable(),
           Column::name('rol')->label('Rol matrícula')->filterable(
              $this->roles->pluck('name')
           )->searchable(),
           Column::name('period')->label(__('modules.input.period'))->filterable()->searchable(),
           Column::name('state')->label(__('modules.input.state'))->filterable(
              $this->state
           ),
           DateColumn::name('created_at')->label(__('modules.table.created'))->filterable(),
        ];
        if (Auth::user()->can('enrollment_write')) {
          array_push($columns, Column::name('id')->view('livewire.datatables.edit')->label('Editar')->alignRight());
        }
        if (Auth::user()->can('enrollment_destroy')){
           array_push($columns, Column::callback(['id', 'code'], function ($id) use ($relation){
              return view('fragments.btn-action-delete', [
                 'value' => $id, 'relation' => $relation
              ]);
           })->label('Eliminar')->alignCenter()->hide());

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