<?php

namespace Database\Factories;

use App\Secret;
use Faker\Generator as Faker;

$factory->define(Secret::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'secret' => $faker->text
    ];
});
