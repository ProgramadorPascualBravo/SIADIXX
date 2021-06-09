<?php


namespace App\Exports;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

/**
 * Libreria https://docs.laravel-excel.com/3.1/exports/
 * Class reportExport
 * @package App\Exports
 */
class reportExport implements FromArray
{
   protected $collection;

   public function __construct($collection)
   {
      $this->collection = $collection;
   }

   public function array() : array
   {
      return $this->collection;
   }


}