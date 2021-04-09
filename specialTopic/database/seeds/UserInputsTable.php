<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserInputsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_inputs')->insert([
            'userID' => 2,
            'ioID' => 2,
            'itemID' => 3,
            'money' => 100,
        ]);
    }
}
