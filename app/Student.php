<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
       'name', 'last_name', 'email', 'password', 'document'
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'email', 'email');
    }

    public function user_external()
    {
       return $this->hasOne(StudentDBMoodle::class, 'username', 'email');
    }
}
