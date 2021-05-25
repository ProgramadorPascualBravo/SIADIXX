<?php


namespace App\Traits;


trait SetParamsTable
{
   public function setNewDate($search)
   {
      $this->params = $search;
      $this->refreshLivewireDatatable();
   }

}