<?php


namespace App\Traits;


trait ClearErrorsLivewireComponent
{
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
