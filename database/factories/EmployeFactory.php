<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employe;
use Faker\Generator as Faker;

$factory->define(Employe::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'entreprise_id' => 1,
        'email' =>  $faker->unique()->safeEmail,
        'tel' => $faker->phoneNumber,
    ];
});
