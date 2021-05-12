<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
        DB::table('documents')->insert([
            'title' => str_random(10),
            'number' => str_random(6),
            'year' => str_random(4),
        ]);
    }
}
