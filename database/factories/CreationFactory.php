<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Creation;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Creation::class, function (Faker $faker) {
    return [
        'user_id'    => $faker->randomElement([1,2]),
        'cover'      => 'https: //source.unsplash.com/1600x900/?nature,water',
        'title'      => $faker->sentence(),
        'content'    => $faker->paragraph(),
        'created_at' => Carbon:: now(),
    ];
});
