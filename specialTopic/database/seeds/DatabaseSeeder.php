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
        // $this->call(UsersTableSeeder::class);
        //$Eas = new EatsTableSeeder;
        //$Eas->run();
        $this->call(UserInputsTable::class);
        $this->call(ItemsTableSeeder::class);
        
    }
}
