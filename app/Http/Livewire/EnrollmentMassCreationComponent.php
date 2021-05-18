<?php


namespace App\Http\Livewire;


use App\Imports\EnrollmentExtendImport;
use App\Imports\EnrollmentImport;
use App\Traits\DownloadDocument;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class EnrollmentMassCreationComponent extends Component
{
   use FlashMessageLivewaire, WithFileUploads, DownloadDocument;

   public $file, $failures = [], $quantity = ['processed' => 0, 'mistakes' => 0], $filename = null, $anexo_user = 0;

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
          if ($this->anexo_user) {
             $import = new EnrollmentExtendImport();
          } else {
            $import = new EnrollmentImport();
         }
         $import->import($this->file);
         $this->quantity = $import->count;
         $this->failures = $import->failures();
         //$this->cancel();
      } catch (FileException | Exception $exception) {
         dd($exception);
      }
   }

   public function cancel()
   {
       $this->file = null;
       $this->failures = [];
       $this->quantity = ['processed' => 0, 'mistakes' => 0];
       $this->filename = null;
       $this->anexo_user = 0;
   }
}