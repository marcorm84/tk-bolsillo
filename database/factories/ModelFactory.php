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

$factory->define(App\Account::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'balance' => $faker->randomFloat(),
        'user_id' => 1,
        'currency_id' => 1,
        'icon' => 'default.png',
        'description' => 'test test test',
    ];
});

$factory->define(App\Transaction::class, function (Faker\Generator $faker) {

    return [
        'title' => 'Transaction Test',
        'account_id' => 1,
        'user_id' => 1,
        'type_id' => 1,
        'category_id' => 1,
        'amount' => 100,
        'description' => 'test test test',
    ];
});

$factory->define(App\Collaborator::class, function (Faker\Generator $faker) {

    return [
        'email' => $faker->email,
        'account_id' => 1,
    ];
});