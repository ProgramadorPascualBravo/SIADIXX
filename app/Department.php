<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'name', 'state'
    ];

    public function programs() : HasMany
    {
        return $this->hasMany(Program::class, 'department_id', 'id');
    }
}
