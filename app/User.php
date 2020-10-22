<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'username', 'password', 'department_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function departament()
    {
        return $this->belongsTo(Departament::class, 'department_id', 'id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    */

}
