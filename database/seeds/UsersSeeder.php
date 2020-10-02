<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::where("role_id", 2)->count() == 0){

            $user = new User;
            $user->name = "Enrique";
            $user->email = "enrique@gmail.com";
            $user->password = bcrypt("12345678");
            $user->role_id = 2;
            $user->save();

            $user = new User;
            $user->name = "Javier";
            $user->email = "javier@gmail.com";
            $user->password = bcrypt("12345678");
            $user->role_id = 2;
            $user->save();

        }
    }
}
