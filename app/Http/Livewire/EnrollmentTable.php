<?php

namespace App\Http\Livewire;

use App\Enrollment;
use App\Group;
use App\RolMoodle;
use App\StateEnrollment;
use App\Traits\DeleteMassive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

/**
 * Libreria https://github.com/mediconesystems/livewire-datatables
 * Class EnrollmentTable
 * @package App\Http\Livewire
 */
class EnrollmentTable extends LivewireDatatable
{
    use DeleteMassive;
    public $model       = Enrollment::class;
    public $hideable    = 'select';
    public $exportable  = true;

    public $relation     = 'enrollment';

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
           Column::checkbox(),
           Column::name('code')->label(Str::title(__('modules.input.code')))->filterable(
              $this->groups->pluck('code')
           )->searchable(),
           Column::name('email')->label(Str::title(__('modules.input.email')))->filterable()->searchable(),
           Column::name('rol')->label(Str::title(__('modules.role-moodle.name')))->filterable(
              $this->roles->pluck('name')
           )->searchable(),
           Column::name('period')->label(Str::title(__('modules.input.period')))->filterable()->searchable(),
           Column::callback(['state_enrollemnt.name'], function($name) {
              return Str::title($name);
           })->label(Str::title(__('modules.input.state')))->filterable(
              $this->states->pluck('name')
           ),
           DateColumn::name('created_at')->label(Str::title(__('modules.table.created')))->filterable(),
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
      return Group::select('code')->where('state', 1)->get();
   }

   public function getRolesProperty()
   {
      return RolMoodle::select('name')->where('state', 1)->get();
   }

   public function getStatesProperty()
   {
      return StateEnrollment::select(['id', 'name'])->where('state', 1)->get();
   }

   public function edit($id)
   {
      $this->emit('edit', $id);
   }
}