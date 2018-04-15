<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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

$factory->define(App\User::class, function (Faker $faker) {
    $priezvisko = $faker->lastName ;
    $meno = $faker->firstName;
    return [
        'meno' => $meno,
        'priezvisko' => $priezvisko,
        'ulica' => $faker->streetName,
        'cislo' => rand(1,100),
        'psc' => $faker->postcode,
        'mesto' => $faker->state,      // krajina =country,
        'popis' => $faker->text(250),
        'stav' => $faker->randomElement(['a','b','c']),
        'login' => $meno . $priezvisko,
        'email' => $faker->unique()->safeEmail,
        'rememberToken' => str_random(10),
//            'password' => Hash::make($data['password']),
        'heslo' => Hash::make('Heslo123') // Pole `heslo` je v DB zašifrované pomocou MD5
    ];
});
