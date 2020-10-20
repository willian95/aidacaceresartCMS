<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsLetterStoreRequest;
use App\User;

class NewsLetterController extends Controller
{
    
    function index(){
        return view("newsLetter.index");
    }

    function store(NewsLetterStoreRequest $request){

        try{

            ini_set("MAX_EXECUTION_TIME", 0);

            $users = User::all();
            $data = ["text" => $request->text, "title" => $request->title];
            foreach($users as $user){
                $to_name = $user->name;
                $to_email = $user->email;
                

                \Mail::send("emails.newsletter", $data, function($message) use ($to_name, $to_email, $request) {

                    $message->to($to_email, $to_name)->subject($request->title);
                    $message->from(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME"));

                });

                
            }

            return response()->json(["success" => true, "msg" => "Newsletter creado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "hubo un problema"]);
        }

    }

}
