<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\User::class, function (Faker $faker) {
    return [
       "name" => $faker->name,
       "last_name" => $faker->lastName,
       "username" => $faker->email,
       "password" => \Illuminate\Support\Facades\Hash::make("123456789"),
       "document" => "123456789",
       "state" => $faker->numberBetween(0, 1),
       "verified" => $faker->numberBetween(0, 1),
       "department_id" => \App\Department::find($faker->numberBetween(1, 5))->id
    ];
});
