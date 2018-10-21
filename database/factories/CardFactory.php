<?php

use Faker\Generator as Faker;
use App\Models\{Card,User};

$factory->define(Card::class, function (Faker $faker) {
    return [
        'user_id'=>function(){return User::all()->random();},
	    'cno'=>$faker->creditCardNumber,
	    'yy'=>$faker->numberBetween(18,25),
	    'mm'=>$faker->numberBetween(1,12),
	    'cvv2'=>$faker->randomDigit
    ];
});
