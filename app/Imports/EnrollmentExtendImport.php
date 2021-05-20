<?php


namespace App\Imports;


use App\Enrollment;
use App\Student;
use App\Traits\FailuresImport;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class EnrollmentExtendImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use FailuresImport, Importable;

    /**
     * @var mixed
     */
    public $values;

    public function __construct()
    {
        $this->failures = new Collection();
    }

    public function model(array $row)
    {
        $this->values = $row;
        $student = Student::where('email', $row['email'])
            ->where('document', $row['document'])
            ->first();
        if (is_null($student)) {
            Student::create([
                'name'      => Str::lower(trim($row['name'])),
                'last_name' => Str::lower(trim($row['last_name'])),
                'email'     => Str::lower(trim($row['email'])),
                'document'  => trim($row['document']),
                'password'  => md5(trim($row['document'])),
            ]);
        }
        $this->sum(true);
        return new Enrollment([
            'code'       => trim($row['code']),
            'rol'        => trim($row['rol']),
            'state'      => trim($row['state']),
            'email'      => trim($row['email']),
            'period'      => trim($row['period'])
        ]);
    }

    public function onError(\Throwable $e)
    {
        if ($this->count['processed'] > 0) {
          $this->count['processed']--;
        }
        $this->count['mistakes']++;
        $array = $this->values;
        $array['errors'] = [[$e->errorInfo[2]]];
        $this->failures->add($array);
    }

    public function rules(): array
    {
       return [
           '*.code'              => 'required|exists:groups,code',
           '*.email'             => 'required',
           '*.rol'               => 'required|exists:roles_moodle,name',
           '*.state'             => 'required',
           '*.document'          => 'required',
           '*.name'              => 'required',
           '*.last_name'         => 'required',
           '*.period'            => 'required|numeric'
       ];
    }
}