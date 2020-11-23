<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
      'codigo', 'name', 'program_id', 'moodle_id', 'state'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }
}
