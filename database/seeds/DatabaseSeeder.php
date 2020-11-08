<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data')->insert([
            'nama' => 'Naufal',
            'password' => '123',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
    }
}
