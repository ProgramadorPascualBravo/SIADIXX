<?php

namespace App\Imports;

use App\Student;
use App\Traits\FailuresImport;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;

/**
 * Libreria https://docs.laravel-excel.com/3.1/imports/
 * Class StudentsImport
 * @package App\Imports
 */
class StudentsImport implements ToModel, WithHeadingRow, SkipsOnFailure, WithValidation, WithProgressBar
{

   use Importable, FailuresImport;

   public function __construct()
   {
      $this->failures = new Collection();
   }

   public function rules(): array
   {
      return [
         'name'          => 'required',
         'last_name'     => 'required',
         'document'      => 'required|unique:students,document|numeric',
         'email'         => 'required|email:rfc|unique:students,email',
      ];
   }

   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $this->sum(true);
        return new Student([
           'name'         => Str::title(trim($row['name'])),
           'last_name'    => Str::title(trim($row['last_name'])),
           'document'     => trim($row['document']),
           'password'     => md5(trim($row['document'])),
           'email'        => trim($row['email']),
        ]);
    }


}
