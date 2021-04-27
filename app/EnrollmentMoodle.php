<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollmentMoodle extends Model
{
    protected $table = 'enrollments_moodle';

    protected $fillable = [
      'code', 'email', 'enrollment_id', 'rol'
    ];
}
