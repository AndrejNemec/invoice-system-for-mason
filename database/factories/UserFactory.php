<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Catalog;
use App\Item;
use App\Unit;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Catalog::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
$factory->define(Unit::class, function (Faker $faker) {
    return [
        'name' => $faker->realText(15),
        'pattern' => ':cena: * :polozka:',
    ];
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Admin',
        'password' => Hash::make('password'),
        'email' => 'admin@admin.com',
        'email_verified_at' => $faker->date(),
        'created_at' => $faker->date(),
        'updated_at' => $faker->date()

    ];
});


$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->realText(15),
        'price' => $faker->randomDigit,
        'catalog_id' => 28,
        'unit_id' => 3

    ];
});
