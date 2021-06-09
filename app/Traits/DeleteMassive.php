<?php


namespace App\Traits;


use App\User;
use Illuminate\Database\QueryException;
use Mockery\Exception;

/**
 * Trait DeleteMassive
 * @package App\Traits
 */
trait DeleteMassive
{
   public function deleteMassive($relation)
   {
      $restrictions = 0;
      if (empty($this->selected)) {
         $this->emit('showAlert', 'alert-error', "Debes tener minimo un elemento seleccionado");
         $this->selected = [];
         return;
      }
      try {
         switch ($relation) {
            case 'enrollment' :
            case 'user'       :
               $this->model::destroy($this->selected);
               break;
            case 'group'            :
            case 'state_enrollment' :
            case 'student'          :
               foreach ($this->selected as $id) {
                  $u = $this->model::find($id);
                  if ($u->enrollments->isEmpty()) {
                     $u->delete();
                  } else {
                     $restrictions++;
                  }
               }
               break;
            case 'category'   :
               foreach ($this->selected as $id) {
                  $u = $this->model::find($id);
                  if ($u->programs->isEmpty()) {
                     $u->delete();
                  } else {
                     $restrictions++;
                  }
               }
               break;
            case 'program'    :
               foreach ($this->selected as $id) {
                  $u = $this->model::find($id);
                  if ($u->courses->isEmpty()) {
                     $u->delete();
                  } else {
                     $restrictions++;
                  }
               }
               break;
            case 'course'     :
               foreach ($this->selected as $id) {
                  $u = $this->model::find($id);
                  if ($u->groups->isEmpty()) {
                     $u->delete();
                  } else {
                     $restrictions++;
                  }
               }
               break;
            default           :
               dd("Not Found relation.");
         }
         if ($restrictions > 0) {
            $this->emit('showAlert', 'alert-info', "Algunos registros no se eliminaron porque tienen restricciones. Total:{$restrictions}");
         } else {
            $this->emit('showAlert', 'alert-success', __('messages.success.delete'));
         }
         $this->selected = [];
      } catch (QueryException $queryException) {
         $this->emit('showAlert', 'alert-error', __('messages.errors.delete'));
      }
   }

   public function deleted($relation, $id)
   {
      $flag = false;
      try {
         switch ($relation) {
            case 'user'       :
            case 'enrollment' :
               $u = $this->model::find($id);
               $flag = $u->delete();
               break;
            case 'group'            :
            case 'state_enrollment' :
            case 'student'          :
               $u = $this->model::find($id);
               if ($u->enrollments->isEmpty()) {
                  $flag = $u->delete();
               }
               $message = "El registro tiene matrículas asociadas.";
               break;
            case 'category'   :
               $u = $this->model::find($id);
               if ($u->programs->isEmpty()) {
                  $flag = $u->delete();
               }
               $message = "La categoria tiene programas asociados.";
               break;
            case 'program'    :
               $u = $this->model::find($id);
               if ($u->courses->isEmpty()) {
                  $flag = $u->delete();
               }
               $message = "La asignatura tiene grupos asociados.";
               break;
            case 'course'     :
               $u = $this->model::find($id);
               if ($u->groups->isEmpty()) {
                  $flag = $u->delete();
               }
               $message = "El grupo tiene matrículas asociadas.";
               break;
            default           :
               dd("Not Found relation.");
         }
         if ($flag) {
            $this->emit('showAlert', 'alert-success', __('messages.success.delete'));
         } else {
            $this->emit('showAlert', 'alert-info', $message);
         }
      } catch (QueryException $queryException) {
         $this->emit('showAlert', 'alert-error', __('messages.errors.delete'));
      }
   }
}