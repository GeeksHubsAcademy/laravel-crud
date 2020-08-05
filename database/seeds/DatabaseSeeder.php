<?php

use App\User;
use Faker\Factory;
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
        Factory(User::class,10)->create();
        $this->call([ProductSeeder::class]);
    }
}
