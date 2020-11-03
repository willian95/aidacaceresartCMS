<?php

use Illuminate\Database\Seeder;
use App\HomeVideo;

class HomeVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(HomeVideo::count() <= 0){
            $home = new HomeVideo;
            $home->save();
        }
    }
}
