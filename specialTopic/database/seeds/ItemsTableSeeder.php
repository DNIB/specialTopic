<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('items')->insert([
            'itemId' => 1,
            'item' => 'eats',
        ]);
    }
}