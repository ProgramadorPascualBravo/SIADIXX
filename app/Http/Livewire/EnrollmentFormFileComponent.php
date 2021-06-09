<?php


namespace App\Http\Livewire;


use App\Exports\FailuresExport;
use App\Imports\EnrollmentExtendImport;
use App\Imports\EnrollmentImport;
use App\Imports\StudentsImport;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\DownloadDocument;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Libreria https://laravel-livewire.com/docs/2.x/quickstart
 * Class EnrollmentFormFileComponent
 * @package App\Http\Livewire
 */
class EnrollmentFormFileComponent extends Component
{
   use WithFileUploads, DownloadDocument, ClearErrorsLivewireComponent;

   public $file, $type = 1;

   public $listeners = ['analyze', 'cancel'];

   public function render()
   {
      return view('livewire.form-file.form-export-enrollment');
   }

   public function analyze()
   {
      $this->validate([
         'file' => 'required|mimes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,xlsx,xls'
      ]);

      try {
         sleep(2);
         if ($this->type) {
            $import = new EnrollmentImport();
         } else {
            $import = new EnrollmentExtendImport();
         }
         $import->import($this->file);
         $this->emit('setQuantity', $import->count);
         if ($import->failures()->count() > 0) {
            return Excel::download(new FailuresExport($import->failures(),
               $this->type == 1 ? 'exports.export-enrollment' : 'exports.export-enrollment-extends'),
               'Errores_Matriculas.xlsx');
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