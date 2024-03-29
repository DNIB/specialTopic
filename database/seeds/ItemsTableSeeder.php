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
            'item' => '餐費',
            'ioID' => 1,
        ]);
        DB::table('items')->insert([
            'id' => 2,
            'item' => '交通',
            'ioID' => 1,
        ]);
        DB::table('items')->insert([
            'id' => 3,
            'item' => '娛樂',
            'ioID' => 1,
        ]);
        DB::table('items')->insert([
            'id' => 4,
            'item' => '其他支出',
            'ioID' => 1,
        ]);
        DB::table('items')->insert([
            'id' => 5,
            'item' => '薪水',
            'ioID' => 2,
        ]);
        DB::table('items')->insert([
            'id' => 6,
            'item' => '其他收入',
            'ioID' => 2,
        ]);
    }
}