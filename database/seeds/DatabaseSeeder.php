<?php

use App\Item;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //factory(\App\Catalog::class, 6)->create();
        //factory(\App\Unit::class, 12)->create();
        factory(User::class, 1)->create();

        //factory(Item::class, 50)->create();
    }
}
