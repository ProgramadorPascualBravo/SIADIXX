<?php


namespace App\Traits;


trait DownloadDocument
{
   public function download(string $basePath) {
      return response()->download(storage_path($basePath));
   }
}