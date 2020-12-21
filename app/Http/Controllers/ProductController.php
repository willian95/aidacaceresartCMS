<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Product;
use App\ProductFormatSize;

class ProductController extends Controller
{
    
    function create(){

        return view("products.create");

    }

    function list(){
        return view("products.list");
    }

    function store(ProductStoreRequest $request){
        ini_set('max_execution_time', 0);

        foreach($request->productFormatSizes as $test){

            if($test["size"] == null || $test["format"] == null || $test["price"] == null){
                //return response()->json($test["format"]["name"]);
                return response()->json(["success" => false, "msg" => "Debe completar todos los campos de las presentaciones"]);
            }

        }

        try{

            $imageData = $request->get('image');

            if(strpos($imageData, "svg+xml") > 0){

                $data = explode( ',', $imageData);
                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                $ifp = fopen($fileName, 'wb' );
                fwrite($ifp, base64_decode( $data[1] ) );
                rename($fileName, 'images/products/'.$fileName);

            }else{

                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->get('image'))->save(public_path('images/products/').$fileName);

            }
            

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

        try{

            $imageData = $request->get('scaleImage');

            if(strpos($imageData, "svg+xml") > 0){

                $data = explode( ',', $imageData);
                $fileNameScale = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                $ifp = fopen($fileNameScale, 'wb' );
                fwrite($ifp, base64_decode( $data[1] ) );
                rename($fileNameScale, 'images/products/'.$fileNameScale);

            }else{

                $fileNameScale = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->get('scaleImage'))->save(public_path('images/products/').$fileNameScale);

            }
            

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

        try{

            $slug = str_replace(" ","-", $request->name);
            $slug = str_replace("/", "-", $slug);

            if(Product::where("slug", $slug)->count() > 0){
                $slug = $slug."-".uniqid();
            }

            $sanitizedDescription = str_replace("\n", "", $request->description);
            $sanitizedDescriptionEnglish = str_replace("\n", "", $request->descriptionEnglish);

            $product = new Product;
            $product->name = $request->name;
            $product->english_name = $request->nameEnglish;
            $product->category_id = $request->category;
            $product->description = $sanitizedDescription;
            $product->english_description = $sanitizedDescriptionEnglish;
            $product->image = url('/').'/images/products/'.$fileName;
            $product->scale_view = url('/').'/images/products/'.$fileNameScale;
            $product->slug = $slug;
            $product->show_on_carousel = $request->showOnCarousel;
            $product->save();

            foreach($request->productFormatSizes as $productFormatSize){

                $slug = $product->slug."-".$productFormatSize["format"]["name"]."-".$productFormatSize["size"]["width"]."-".$productFormatSize["size"]["height"];

                if(ProductFormatSize::where("slug", $slug)->count() > 0){
                    $slug = $slug."-".uniqid();
                }

                $productFormatSizeModel = new ProductFormatSize;
                $productFormatSizeModel->product_id = $product->id;
                //$productFormatSizeModel->format_id = $productFormatSize["format"]["id"];
                $productFormatSizeModel->format_id = 1;
                $productFormatSizeModel->size_id = $productFormatSize["size"]["id"];
                $productFormatSizeModel->price = $productFormatSize["price"];
                $productFormatSizeModel->slug = $slug;
                $productFormatSizeModel->save();

            }

            return response()->json(["success" => true, "msg" => "Producto creado"]);

        }catch(\Exception $e){
            return response()->json(["success" => true, "false" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function fetch($page){

        try{

            $dataAmount = 20;
            $skip = ($page - 1) * $dataAmount;

            $query = Product::with(['category' => function ($q) {
                $q->withTrashed();
            }])->with(['productFormatSizes' => function ($q) {
                $q->withTrashed();
            }])->with(['productFormatSizes.size' => function ($q) {
                $q->withTrashed();
            }]);
           
            $products = $query->skip($skip)->take($dataAmount)->get();
            $productsCount = $query->count();

            return response()->json(["success" => true, "products" => $products, "productsCount" => $productsCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => true, "false" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function edit($id){

        $product = Product::with(['category' => function ($q) {
            $q->withTrashed();
        }])->with(['productFormatSizes' => function ($q) {
            $q->withTrashed();
        }])->with(['productFormatSizes.size' => function ($q) {
            $q->withTrashed();
        }])->where("id", $id)->first();

        return view("products.edit", ["product" => $product]);

    }

    function update(ProductUpdateRequest $request){
        ini_set('max_execution_time', 0);

        foreach($request->productFormatSizes as $test){

            if($test["size"] == null || $test["price"] == null){
                //return response()->json($test["format"]["name"]);
                return response()->json(["success" => false, "msg" => "Debe completar todos los campos de las presentaciones"]);
            }

        }

        if($request->get("image") != null){

            try{

                $imageData = $request->get('image');
    
                if(strpos($imageData, "svg+xml") > 0){
    
                    $data = explode( ',', $imageData);
                    $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                    $ifp = fopen($fileName, 'wb' );
                    fwrite($ifp, base64_decode( $data[1] ) );
                    rename($fileName, 'images/products/'.$fileName);
    
                }else{
    
                    $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                    Image::make($request->get('image'))->save(public_path('images/products/').$fileName);
    
                }
                
    
            }catch(\Exception $e){
    
                return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
    
            }

        }

        if($request->get("scaleImage") != null){
            try{

                $imageData = $request->get('scaleImage');

                if(strpos($imageData, "svg+xml") > 0){

                    $data = explode( ',', $imageData);
                    $fileNameScale = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                    $ifp = fopen($fileNameScale, 'wb' );
                    fwrite($ifp, base64_decode( $data[1] ) );
                    rename($fileName, 'images/products/'.$fileNameScale);

                }else{

                    $fileNameScale = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                    Image::make($request->get('scaleImage'))->save(public_path('images/products/').$fileNameScale);

                }
                

            }catch(\Exception $e){

                return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);

            }
        }


        try{

            $sanitizedDescription = str_replace("\n", "", $request->description);
            $sanitizedDescriptionEnglish = str_replace("\n", "", $request->descriptionEnglish);

            $product = Product::find($request->id);
            $product->name = $request->name;
            $product->english_name = $request->nameEnglish;
            $product->category_id = $request->category;
            $product->show_on_carousel = $request->showOnCarousel;
            $product->description = $sanitizedDescription;
            $product->english_description = $sanitizedDescriptionEnglish;
            if($request->get("image") != null){
                $product->image =  url('/').'/images/products/'.$fileName;
            }
            if($request->get("scaleImage") != null){
                $product->scale_view =  url('/').'/images/products/'.$fileNameScale;
            }
            $product->update();

            $productTypeArray = [];
            $productTypes = ProductFormatSize::where("product_id", $product->id)->get();
            foreach($productTypes as $productType){
                array_push($productTypeArray, $productType->id);
            }

            $requestArray = [];
            foreach($request->productFormatSizes as $productTypeSizeRequest){
                if(array_key_exists("id", $productTypeSizeRequest)){
                    array_push($requestArray, $productTypeSizeRequest["id"]);
                }
            }

            $deleteProductTypes = array_diff($productTypeArray, $requestArray);
            
            foreach($deleteProductTypes as $productDelete){
                ProductFormatSize::where("id", $productDelete)->delete();
            }

            foreach($request->productFormatSizes as $productTypeSize){
                
                if(array_key_exists("id", $productTypeSize)){

                    if(ProductFormatSize::where("id", $productTypeSize["id"])->count() > 0){
                        $productType = ProductFormatSize::find($productTypeSize["id"]);
                        $productType->product_id = $product->id;
                        //$productType->format_id = $productTypeSize["format"]["id"];
                        $productType->format_id = 1;
                        $productType->size_id = $productTypeSize["size"]["id"];
                        $productType->price = $productTypeSize["price"];
                        $productType->update();
                    }

                }else{

                    $slug = $product->slug."-".$productTypeSize["format"]["name"]."-".$productTypeSize["size"]["width"]."-".$productTypeSize["size"]["height"];

                    if(ProductFormatSize::where("slug", $slug)->count() > 0){
                        $slug = $slug."-".uniqid();
                    }

                    $productType = new ProductFormatSize;
                    $productType->product_id = $product->id;
                    //$productType->format_id = $productTypeSize["format"]["id"];
                    $productType->format_id = 1;
                    $productType->size_id = $productTypeSize["size"]["id"];
                    $productType->price = $productTypeSize["price"];
                    $productType->slug = $slug;
                    $productType->save();
                }
                

            }

            return response()->json(["success" => true, "msg" => "Producto actualizado"]);

        }catch(\Exception $e){
            return response()->json(["success" => true, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function delete(Request $request){

        try{

            Product::where("id", $request->id)->delete();
            ProductFormatSize::where("product_id", $request->id)->delete();

            return response()->json(["success" => true, "msg" => "Producto eliminado"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

}
