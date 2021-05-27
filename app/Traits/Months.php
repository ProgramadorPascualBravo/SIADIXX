<?php


namespace App\Traits;


use Arr;

trait Months
{
   public $months = [
      '01' => 'Enero',
      '02' => 'Febrero',
      '03' => 'Marzo',
      '04' => 'Abril',
      '05' => 'Mayo',
      '06' => 'Junio',
      '07' => 'Julio',
      '08' => 'Agosto',
      '09' => 'Septiembre',
      '10' => 'Octubre',
      '11' => 'Noviembre',
      '12' => 'Diciembre',
   ];

   public function getMonths()
   {
      return Arr::flatten($this->months);
   }

   protected function organizeDataByMonth($eloquent)
   {
      $data = collect();
      foreach ($this->months as $key => $value) {
         if ($eloquent->keys()->search($key)) {
            $data->put($value, $eloquent->get($key));
            continue;
         }
         $data->put($value, 0);
      }
      return $data;
   }

   protected function getMonth($month)
   {
      return $this->months[$month];
   }

}