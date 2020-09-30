<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($i = 1; $i < 3; $i++){

            if(Role::where("id", $i)->count() == 0){

                $role = new Role;
                if($i == 1){
                    $role->name = "Admin";
                }else if($i == 2){
                    $role->name = "Usuario";
                }
                $role->save();
                 

            }

        }

    }
}
