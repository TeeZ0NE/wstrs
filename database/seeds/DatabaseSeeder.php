<?php

use Illuminate\Database\Seeder;
use App\Models\{User,Card,Transaction};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CustomerSeeder::class);
         factory(User::class,10)->create();
         factory(Card::class,10)->create();
         factory(Transaction::class,10)->create();
    }
}
