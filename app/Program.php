<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';

    protected $fillable = [
        'name', 'state', 'department_id', 'state', 'faculty'
    ];

    public function departament()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
