<?php

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
        $this->call([
            StatesSeeder::class,
            CitiesSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            // Other seeders if any
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
