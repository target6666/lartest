<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        //
        'artno' => $faker->numberBetween(100000000,999999999),
        'name' => $faker->text(30),
        'desc1' => $faker->text(20),
        'category_id' => $faker->numberBetween(1,10),
        'vol_l' => $faker->numberBetween(2,20)*10,
        'vol_b' => $faker->numberBetween(2,20)*10,
        'vol_h' => $faker->numberBetween(2,20)*10,
        'weight' => $faker->numberBetween(2,20)*100
    ];
});
