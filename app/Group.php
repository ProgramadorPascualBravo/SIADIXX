<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
      'name', 'code', 'course_id', 'state', 'period', 'short_name'
    ];

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function enrollments()
    {
       return $this->hasMany(Enrollment::class, 'code', 'code');
    }
}
