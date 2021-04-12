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
            'id' => 1,
            'item' => 'eats',
        ]);
        DB::table('items')->insert([
            'id' => 2,
            'item' => 'traffic',
        ]);
        DB::table('items')->insert([
            'id' => 3,
            'item' => 'enterment',
        ]);
        DB::table('items')->insert([
            'id' => 4,
            'item' => 'test4',
        ]);
        DB::table('items')->insert([
            'id' => 5,
            'item' => 'test5',
        ]);
        DB::table('items')->insert([
            'id' => 6,
            'item' => 'test6',
        ]);
    }
}