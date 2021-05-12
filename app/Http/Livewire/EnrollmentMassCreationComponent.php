<?php


namespace App\Http\Livewire;


use App\Imports\EnrollmentImport;
use App\Imports\T;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class EnrollmentMassCreationComponent extends Component
{
   use FlashMessageLivewaire, WithFileUploads;

   public $file, $failures = [], $quantity = ['processed' => 0, 'mistakes' => 0], $filename = null;

   public function render()
   {
      return view('livewire.enrollment.mass-creation-component');
   }

   public function analyze()
   {
      $this->validate([
         'file' => 'required|mimes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,xlsx,xls'
      ]);
      $this->filename = $this->file->getClientOriginalName();
      try {

         $import = new EnrollmentImport();
         $import->import($this->file);
         $this->quantity = $import->count;
         $this->failures = $import->failures();

      } catch (FileException | QueryException | Exception $exception) {
         dd($exception);
      }
   }
}