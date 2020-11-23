<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'name', 'state'
    ];

    public function programs()
    {
        return $this->hasMany(Program::class, 'department_id', 'id');
    }
}
