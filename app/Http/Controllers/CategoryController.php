<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Category;

class CategoryController extends Controller
{
    
    function index(){
        return view("categories.index");
    }

    function store(CategoryStoreRequest $request){

        try{

            $imageData = $request->get('image');

            if(strpos($imageData, "svg+xml") > 0){

                $data = explode( ',', $imageData);
                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                $ifp = fopen($fileName, 'wb' );
                fwrite($ifp, base64_decode( $data[1] ) );
                rename($fileName, 'images/brands/'.$fileName);

            }else{

                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->get('image'))->save(public_path('images/categories/').$fileName);

            }

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

        try{

            $slug = str_replace(" ", "-", $request->name);
            $slug = str_replace("/", "-", $slug);

            if(Category::where("slug", $slug)->count() > 1){
                $slug = $slug."-".uniqid();
            }

            $category = new Category;
            $category->name = $request->name;
            $category->image = url('images/categories/').'/'.$fileName;
            $category->slug = $slug;
            $category->save();

            return response()->json(["success" => true, "msg" => "Categoría creada"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }
        
    }

    function fetch($page = 1){

        try{

            $dataAmount = 20;
            $skip = ($page - 1) * $dataAmount;

            $categories = Category::skip($skip)->take($dataAmount)->get();
            $categoriesCount = Category::count();

            return response()->json(["success" => true, "categories" => $categories, "categoriesCount" => $categoriesCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor"]);

        }

    }

    function update(CategoryUpdateRequest $request){

        if($request->get('image') != null){

            try{

                $imageData = $request->get('image');
    
                if(strpos($imageData, "svg+xml") > 0){
    
                    $data = explode( ',', $imageData);
                    $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                    $ifp = fopen($fileName, 'wb' );
                    fwrite($ifp, base64_decode( $data[1] ) );
                    rename($fileName, 'images/brands/'.$fileName);
    
                }else{
    
                    $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                    Image::make($request->get('image'))->save(public_path('images/categories/').$fileName);
    
                }
    
            }catch(\Exception $e){
    
                return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
    
            }

        }

        try{

            if(Category::where('name', $request->name)->where('id', '<>', $request->id)->count() == 0){
                
                $category = Category::find($request->id);
                $category->name = $request->name;
                if($request->get('image') != null){
                    $category->image = url('images/categories/').'/'.$fileName;
                }
                $category->update();

                return response()->json(["success" => true, "msg" => "Categoría actualizada"]);
            
            }else{

                return response()->json(["success" => false, "msg" => "Este nombre ya existe"]);

            }

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }
        
    }

    function delete(Request $request){

        try{

            $category = Category::find($request->id);
            $category->delete();

            return response()->json(["success" => true, "msg" => "Categoría eliminada"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor"]);

        }

    }

}
