<?php

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'minPlayer' => 1,
        'maxPlayer' => $faker->randomDigitNotNull,
        'duration' => $faker->randomDigit,
        'description' => $faker->text,
    ];
});
