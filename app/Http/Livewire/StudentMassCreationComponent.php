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
use Maatwebsite\Excel\Facades\Excel;;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class StudentMassCreationComponent extends Component
{
   use FlashMessageLivewaire, WithFileUploads, DownloadDocument, ClearErrorsLivewireComponent;

   public $quantity = null, $anexo_user = 0;

   protected $listeners = ['setQuantity'];

   public function render()
   {
      return view('livewire.student.mass-creation-component');
   }

   public function cancel()
   {
       $this->quantity = null;
       $this->hydrate();
       $this->emit('cancel');
   }

   public function setQuantity(array $quantity)
   {
      $this->quantity = $quantity;
   }
}