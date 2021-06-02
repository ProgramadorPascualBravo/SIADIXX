<?php


namespace App\Http\Livewire;


use App\Imports\EnrollmentExtendImport;
use App\Imports\EnrollmentImport;
use App\Traits\ClearErrorsLivewireComponent;
use App\Traits\DownloadDocument;
use App\Traits\FlashMessageLivewaire;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class EnrollmentMassCreationComponent extends Component
{
   use FlashMessageLivewaire, WithFileUploads, DownloadDocument, ClearErrorsLivewireComponent;

   public $quantity = null;

   protected $listeners = ['setQuantity'];

   public function render()
   {
      return view('livewire.enrollment.mass-creation-component');
   }

   public function cancel()
   {
       $this->quantity = null;
       $this->emit('cancel');
       $this->hydrate();
   }

   public function setQuantity(array $quantity)
   {
      $this->quantity = $quantity;
   }
}