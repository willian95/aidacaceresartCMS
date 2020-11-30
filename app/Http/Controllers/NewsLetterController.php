<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsLetterStoreRequest;
use App\User;
use App\NewsletterEmail;

class NewsLetterController extends Controller
{
    
    function index(){
        return view("newsLetter.index");
    }

    function store(NewsLetterStoreRequest $request){

        try{

            ini_set("MAX_EXECUTION_TIME", 0);
            $users = User::all();

            foreach($users as $user){

                if($user->role_id == 2){
                    $newsletter = new NewsletterEmail;
                    $newsletter->title = $request->title;
                    $newsletter->body = $request->text;
                    $newsletter->recipient_email = $user->email;
                    $newsletter->name = $user->name;
                    $newsletter->save();
                }

            }


            /*$data = ["text" => $request->text, "title" => $request->title];
            foreach($users as $user){
                $to_name = $user->name;
                $to_email = $user->email;
                

                \Mail::send("emails.newsletter", $data, function($message) use ($to_name, $to_email, $request) {

                    $message->to($to_email, $to_name)->subject($request->title);
                    $message->from(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME"));

                });

                
            }*/

            return response()->json(["success" => true, "msg" => "Newsletter creado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

}
