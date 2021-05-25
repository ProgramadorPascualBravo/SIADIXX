<?php


namespace App\Http\Livewire;


use App\Imports\StudentExcel;
use App\Imports\StudentsImport;
use App\Student;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\DownloadDocument;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class StudentMassCreationComponent extends Component
{
   use FlashMessageLivewaire, WithFileUploads, DownloadDocument, ClearErrorsLivewireComponent;

   public $file, $failures = [], $quantity = ['processed' => 0, 'mistakes' => 0], $process = false;

   public function render()
   {
      return view('livewire.student.mass-creation-component');
   }

   public function analyze()
   {
      $this->proccess = true;
      $this->validate([
         'file' => 'required|mimes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,xlsx,xls'
      ]);

      try {

         $import = new StudentsImport();

         $import->import($this->file);

         $this->quantity = $import->count;

         $this->failures = $import->failures();
         $this->process = false;
      } catch (FileException | QueryException | Exception $exception) {
         $this->proccess = false;
         dd($exception);
      }
   }

   public function cancel()
   {

       $this->file = null;
       $this->failures = [];
       $this->quantity = ['processed' => 0, 'mistakes' => 0];
       $this->filename = null;
       $this->hydrate();

   }
}