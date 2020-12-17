<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
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

            $users = User::with("country")->skip($skip)->where("role_id", 2)->take($dataAmount)->get();
            $usersCount = User::with("country")->where("role_id", 2)->count();

            return response()->json(["success" => true, "clients" => $users, "clientsCount" => $usersCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor"]);

        }
    }

    function excelExport(){
        return Excel::download(new UsersExport, 'clientes.xlsx');
    }

    function csvExport(){
        return Excel::download(new UsersExport, 'clientes.csv');
    }

    

}
