<?php

namespace App;

use App\Traits\MonthScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Manager;

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

   public function last_entry()
   {
      return Manager::connection('mysql_moodle')
         ->select("SELECT DATE_FORMAT(FROM_UNIXTIME(la.timeaccess),'%d-%m-%Y') AS ultimoCur  
            FROM mdl_user u, mdl_role_assignments ra, mdl_context c, mdl_course co, mdl_user_lastaccess la 
            WHERE u.id=ra.userid AND ra.contextid = c.id AND c.instanceid=co.id 
            AND u.id=la.userid AND co.id=la.courseid 
            AND u.username='$this->email' AND co.idnumber='$this->code'");
   }
}
