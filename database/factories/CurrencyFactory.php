<?php

use Faker\Generator as Faker;

$factory->define(App\Entity\Currency::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'short_name' => $faker->unique()->word,
        'logo_url' => $faker->url,
        'rate' => $faker->randomFloat(2, 0, 100000),
    ];
});
