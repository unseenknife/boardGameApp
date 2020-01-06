<?php

use Faker\Generator as Faker;

$factory->define(App\Battle::class, function (Faker $faker) {
    return [
        'battleName' => $faker->name,
        'dtPlayed' => $faker->dateTime,
        'game_id' => $faker->numberBetween(1, App\Game::count()),
        'player_id' => $faker->numberBetween(1, App\Player::count()),
        'wonby' => $faker->numberBetween(1, App\Player::count())
    ];
});
