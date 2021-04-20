<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserInputsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 50; $i++) {
            // 透過 DB class 建立資料
            DB::table('user_inputs')->insert([
                'userID' => rand(1, 3),
                'itemID' => rand(1, 6),
                'describe' => rand(1, 2),
                'money' => rand(1, 3000),
            ]);
        }

        DB::table('users')->insert([
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$mNEmur6PjzUooD7S4jC5uu6OIW0ZbWbqKkYd70d8.I3oFG902dEoy',
        ]);
    }
}
