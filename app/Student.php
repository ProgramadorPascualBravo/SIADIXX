<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
       'name', 'last_name', 'email', 'password', 'document', 'country', 'department', 'city', 'address', 'telephone', 'cellphone'
    ];
}
