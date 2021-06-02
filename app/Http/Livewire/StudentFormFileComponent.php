<?php


namespace App\Http\Livewire;


use App\Exports\FailuresExport;
use App\Imports\StudentsImport;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\DownloadDocument;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class StudentFormFileComponent extends Component
{
   use WithFileUploads, DownloadDocument, ClearErrorsLivewireComponent;

   public $file;

   public $listeners = ['analyze'];

   public function render()
   {
      return view('livewire.form-file.form-export-student');
   }

   public function analyze()
   {
      $this->validate([
         'file' => 'required|mimes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,xlsx,xls'
      ]);

      try {
         sleep(2);
         $import = new StudentsImport();
         $import->import($this->file);
         $this->emit('setQuantity', $import->count);
         if ($import->failures()->count() > 0) {
            return Excel::download(new FailuresExport($import->failures(), 'exports.export-student'), 'Errores_Usuarios.xlsx');
         }
      } catch (FileException | QueryException | \Exception $exception) {
         dd($exception->getMessage());
      }
   }

   public function cancel()
   {
      $this->file = null;
   }
}