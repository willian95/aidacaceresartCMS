<?php

use Illuminate\Database\Seeder;
use App\Format;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        if(Format::count() == 0){
            $format = new Format;
            $format->id = 1;
            $format->name = "Default";
            $format->english_name = "Default";
            $format->save();
        }

    }
}
