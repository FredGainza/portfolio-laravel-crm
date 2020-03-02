<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Entreprise;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Entreprise::class, function (Faker $faker) {
    $name = $faker->company;
    $logo = Str::slug($name, '-').'_logo.jpg';
    return [
        'name' => $name,
        'email' => $faker->unique()->safeEmail,
        'logo' => 'default_logo.png',
        'site' => $faker->url,
    ];
});
