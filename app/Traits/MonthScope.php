<?php


namespace App\Traits;


use Carbon\Carbon;

trait MonthScope
{
      public function scopeMonth($query)
      {
         $query->whereMonth('created_at', Carbon::now()->month);
      }
}