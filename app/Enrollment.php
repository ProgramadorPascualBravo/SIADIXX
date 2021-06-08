<?php

namespace App;

use App\Traits\MonthScope;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
   use MonthScope;

   protected $table = 'enrollments';

    protected $fillable = [
      'email', 'code', 'rol', 'state', 'period'
    ];

    public function group()
    {
       return $this->belongsTo(Group::class, 'code', 'code');
    }

    public function user()
    {
       return $this->belongsTo(Student::class, 'email', 'email');
    }

    public function state_enrollemnt()
    {
       return $this->belongsTo(StateEnrollment::class, 'state', 'id');
    }

    public function enrollment_moodle()
    {
       return $this->hasOne(EnrollmentMoodle::class, 'enrollment_id', 'id');
    }

}
