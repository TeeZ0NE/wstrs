<?php

use Faker\Generator as Faker;
use App\Models\{Transaction,Card,User};
$factory->define(Transaction::class, function (Faker $faker) {

    return [
        'user_id'=>function(){return $user_id=User::all()->random();},
	    'card_id'=>function($user_id){return $id=Card::where('user_id',(int)$user_id)->first()->id;},
	    'amount'=>$faker->randomDigit,
	    'date'=>$faker->date(now())
    ];
});
