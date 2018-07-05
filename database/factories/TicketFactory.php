<?php

use Faker\Generator as Faker;

$factory->define(App\Ticket::class, function (Faker $faker) {
    return [
        'to' => '1',
        'from' => $faker->name,
        'company' => $faker->company,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'order_no' => $faker->randomNumber(6),
        'acct_no' => $faker->randomNumber(5),
        'user_id' => '2',
        'type' => 'eTraining',
        'message' => $faker->sentence(),
        'status' => 'Open',
        'notes' => $faker->sentence(),
    ];
});
