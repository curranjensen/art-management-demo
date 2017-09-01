<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Detail::class, function (Faker\Generator $faker) {
    return [
        'piece_id' =>function () {
            return factory(App\Piece::class)->create()->id;
        },
        'original_file_name' => 'original_file.jpg',
        'file_name' => 'saved_file.jpg',
        'width' => 800,
        'height' => 600
    ];
});

$factory->define(App\Piece::class, function (Faker\Generator $faker) {
    return [
        'number' => $faker->randomNumber(null, true)
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'slug' => str_slug($faker->word)
    ];
});