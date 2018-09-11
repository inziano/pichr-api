<?php

use Faker\Generator as Faker;

use Modules\User\Entities\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        //
        'username'=> $faker->userName,
        'email'=> $faker->email,
        'password'=> $faker->password
    ];
});
