<?php
namespace App\Traits;

trait FlashMessageLivewaire
{
   public $message;
   protected function showAlert(string $type, string $message)
   {
      $this->message = $message;
      $this->emit($type);
   }

   protected function refreshTable()
   {
      $this->emit('refreshLivewireDatatable');
   }
}