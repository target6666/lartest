<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->text(20),
        'parent_id' => $faker->numberBetween(1,5),
        'artno_min' => $faker->numberBetween(10,50)*100000,
        'artno_max' => $faker->numberBetween(59,99)*100000
    ];
});
