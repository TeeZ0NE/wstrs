<?php

use Faker\Generator as Faker;
use App\Models\{Transaction,Card,User};
$factory->define(Transaction::class, function (Faker $faker) {

    return [
        'user_id'=>function(){return User::all()->random();},
	    'card_id'=>function(){return Card::all()->random();},
	    'amount'=>$faker->randomDigit,
	    'date'=>$faker->dateTimeBetween('-1 week','+1 week')
    ];
});
