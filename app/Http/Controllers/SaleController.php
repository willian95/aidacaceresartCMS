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

            $shoppings = Payment::with("productPurchases", "user", "productPurchases.productFormatSize", "productPurchases.productFormatSize.product", "productPurchases.productFormatSize.format", "productPurchases.productFormatSize.size")->has("productPurchases")
            ->has("productPurchases.productFormatSize")->has( "productPurchases.productFormatSize.product")->has( "productPurchases.productFormatSize.format")->has( "productPurchases.productFormatSize.size")
            ->skip($skip)->take($dataAmount)->orderBy('id', 'desc')->get();
            $shoppingsCount = Payment::with("productPurchases", "user", "productPurchases.productFormatSize", "productPurchases.productFormatSize.product", "productPurchases.productFormatSize.format", "productPurchases.productFormatSize.size")->has("productPurchases")
            ->has("productPurchases.productFormatSize")->has( "productPurchases.productFormatSize.product")->has( "productPurchases.productFormatSize.format")->has( "productPurchases.productFormatSize.size")->count();

            return response()->json(["success" => true, "shoppings" => $shoppings, "shoppingsCount" => $shoppingsCount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

}
