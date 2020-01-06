<?php

use Faker\Generator as Faker;

$factory->define(App\Player::class, function (Faker $faker) {
    return [
        'nickname' => $faker->name,
        'gameStatus' => 'online',
        'cursor' => 1,

    ];
});
