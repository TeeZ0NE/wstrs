<?php

use Illuminate\Database\Seeder;
use App\Models\{User,Transaction,Card};

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_m = new User();
        $user_m->username = 'Johnson';
        $user_m->password = bcrypt('111111');
        $user_m->save();
        $user_id = $user_m->id;

        $card_m = new Card();
        $card_m->user_id = $user_id;
        $card_m->cno = 1111222233334444;
        $card_m->yy = 20;
        $card_m->mm = 10;
        $card_m->cvv2 = 123;
        $card_m->save();
        $card_id = $card_m->id;

        $transaction_m = new Transaction();
        $transaction_m->user_id = $user_id;
        $transaction_m->amount = 123.45;
        $transaction_m->card_id = $card_id;
        $transaction_m->date = date(now());
        $transaction_m->save();
    }
}
