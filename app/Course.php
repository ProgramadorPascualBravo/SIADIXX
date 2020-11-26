<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
      'code', 'name', 'program_id', 'moodle_id', 'state'
    ];

    public function program() : BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }

    public function groups() : HasMany
    {
        return $this->hasMany(Group::class, 'course_id', 'id');
    }
}
