<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormatStoreRequest;
use App\Http\Requests\FormatUpdateRequest;
use App\Format;

class FormatController extends Controller
{
    function index(){
        return view("format.index");
    }

    function all(){
        return response()->json(["formats" => Format::all()]);
    }

    function store(FormatStoreRequest $request){


        try{


            $format = new Format;
            $format->name = $request->name;
            $format->save();

            return response()->json(["success" => true, "msg" => "Formato creada"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }
        
    }

    function fetch($page = 1){

        try{

            $dataAmount = 20;
            $skip = ($page - 1) * $dataAmount;

            $formats = Format::skip($skip)->take($dataAmount)->get();
            $formatsCount = Format::count();

            return response()->json(["success" => true, "formats" => $formats, "formatsCount" => $formatsCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor"]);

        }

    }

    function update(FormatUpdateRequest $request){

        try{

            if(Format::where('name', $request->name)->where('id', '<>', $request->id)->count() == 0){
                
                $format = Format::find($request->id);
                $format->name = $request->name;
                $format->update();

                return response()->json(["success" => true, "msg" => "Formato actualizado"]);
            
            }else{

                return response()->json(["success" => false, "msg" => "Este nombre ya existe"]);

            }

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }
        
    }

    function delete(Request $request){

        try{

            $format = Format::find($request->id);
            $format->delete();

            return response()->json(["success" => true, "msg" => "Formato eliminado"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor"]);

        }

    }
}
