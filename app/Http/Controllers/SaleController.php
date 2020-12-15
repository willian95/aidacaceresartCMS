<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;

class SaleController extends Controller
{
    function index(){

        return view("sales.index");

    }

    function fetch($page = 1){

        try{

            $dataAmount = 20;
            $skip = ($page - 1) * $dataAmount;

            $shoppings = Payment::with("productPurchases", "user", "guestUser")
            ->with(['productPurchases.productFormatSize' => function ($q) {
                $q->withTrashed();
            }])
            ->with(['productPurchases.productFormatSize.product' => function ($q) {
                $q->withTrashed();
            }])
            ->with('productPurchases.productFormatSize.format')
            ->with(['productPurchases.productFormatSize.size' => function ($q) {
                $q->withTrashed();
            }])->orderBy('id', 'desc')->skip($skip)->take($dataAmount)->get();

            $shoppingsCount = Payment::with("productPurchases", "user", "guestUser")
            ->with(['productPurchases.productFormatSize' => function ($q) {
                $q->withTrashed();
            }])
            ->with(['productPurchases.productFormatSize.product' => function ($q) {
                $q->withTrashed();
            }])
            ->with('productPurchases.productFormatSize.format')
            ->with(['productPurchases.productFormatSize.size' => function ($q) {
                $q->withTrashed();
            }])->orderBy('id', 'desc')->count();

            return response()->json(["success" => true, "shoppings" => $shoppings, "shoppingsCount" => $shoppingsCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

}
