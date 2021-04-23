<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolMoodle extends Model
{
    protected $table = 'roles_moodle';

    protected $fillable = ['name'];
}
