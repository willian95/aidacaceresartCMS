<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\User;
use App\GuestUser;
use App\ProductPurchase;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;

class SaleController extends Controller
{
    function index(){

        return view("sales.index");

    }

    function fetch($page = 1){

        try{

            $dataAmount = 20;
            $skip = ($page - 1) * $dataAmount;

            $shoppings = Payment::with("user", "user.country", "guestUser", "guestUser.country")
            ->with(['productPurchases.productFormatSize' => function ($q) {
                $q->withTrashed();
                $q->with(['product' => function ($k) {
                    $k->withTrashed();
                }]);
                $q->with(['size' => function ($k) {
                    $k->withTrashed();
                }]);
            }])
            ->orderBy('id', 'desc')->skip($skip)->take($dataAmount)->get();

            $shoppingsCount = Payment::with("user", "guestUser")
            ->with(['productPurchases.productFormatSize' => function ($q) {
                $q->withTrashed();
                $q->with(['product' => function ($k) {
                    $k->withTrashed();
                }]);
                $q->with(['size' => function ($k) {
                    $k->withTrashed();
                }]);
            }])->orderBy('id', 'desc')->count();

            return response()->json(["success" => true, "shoppings" => $shoppings, "shoppingsCount" => $shoppingsCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function sendTracking(Request $request){

        try{

            $products = ProductPurchase::where("payment_id", $request->paymentId)->with("productFormatSize", "productFormatSize.product", "productFormatSize.size")->has("productFormatSize")->get();

            $payment = Payment::where("id", $request->paymentId)->first();
            $payment->tracking = $request->tracking;
            $payment->update();

            $user = null;
            if($request->user == 'auth'){
                $user = User::where("email", $request->email)->first();
            }else{
                $user = GuestUser::where("email", $request->email)->first();
            }

            $to_name = $user->name;
            $to_email = $user->email;
            $data = ["user" => $user, "products" => $products, "tracking" => $request->tracking, "payment" => $payment];

            \Mail::send("emails.tracking", $data, function($message) use ($to_name, $to_email) {

                $message->to($to_email, $to_name)->subject("Order Shipped. Track your order!");
                $message->from(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME"));

            });

            return response()->json(["success" => true, "Notificación enviada al cliente"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function excelExport(){
        return Excel::download(new SalesExport, 'ventas.xlsx');
    }

    function csvExport(){
        return Excel::download(new SalesExport, 'ventas.csv');
    }
    

}
