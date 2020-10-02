<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    
    function index(){
        return view("users.index");
    }

    function fetch($page){
        try{

            $dataAmount = 20;
            $skip = ($page - 1) * $dataAmount;

            $users = User::skip($skip)->where("role_id", 2)->take($dataAmount)->get();
            $usersCount = User::where("role_id", 2)->count();

            return response()->json(["success" => true, "clients" => $users, "clientsCount" => $usersCount]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor"]);

        }
    }

}
