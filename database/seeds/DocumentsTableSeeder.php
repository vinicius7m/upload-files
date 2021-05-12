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
        factory(App\Document::class, 10)->create();
    }
}
