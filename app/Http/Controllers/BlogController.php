<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Blog;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    
    function index(){

        return view("blogs.index");

    }

    function store(BlogStoreRequest $request){

        try{

            if($request->get("image") != null){

                try{
    
                    $imageData = $request->get('image');
        
                    if(strpos($imageData, "svg+xml") > 0){
        
                        $data = explode( ',', $imageData);
                        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                        $ifp = fopen($fileName, 'wb' );
                        fwrite($ifp, base64_decode( $data[1] ) );
                        rename($fileName, 'images/blogs/'.$fileName);
        
                    }else{
        
                        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                        Image::make($request->get('image'))->save(public_path('images/blogs/').$fileName);
        
                    }
                    
        
                }catch(\Exception $e){
        
                    return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        
                }
    
            }

            $blog = new Blog;
            $blog->title = $request->title;
            $blog->english_title = $request->englishTitle;
            $blog->description = $request->description;
            $blog->english_description = $request->englishDescription;
            $blog->date = $request->date;
            $blog->image = url('/images/blogs/')."/".$fileName;
            $blog->save();

            return response()->json(["success" => true]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function update(BlogUpdateRequest $request){

        try{

            if($request->get("image") != null){

                try{
    
                    $imageData = $request->get('image');
        
                    if(strpos($imageData, "svg+xml") > 0){
        
                        $data = explode( ',', $imageData);
                        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                        $ifp = fopen($fileName, 'wb' );
                        fwrite($ifp, base64_decode( $data[1] ) );
                        rename($fileName, 'images/blogs/'.$fileName);
        
                    }else{
        
                        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                        Image::make($request->get('image'))->save(public_path('images/blogs/').$fileName);
        
                    }
                    
        
                }catch(\Exception $e){
        
                    return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        
                }
    
            }

            $blog = Blog::where("id", $request->id)->first();
            $blog->title = $request->title;
            $blog->english_title = $request->englishTitle;
            $blog->description = $request->description;
            $blog->english_description = $request->englishDescription;
            $blog->date = $request->date;
            if($request->get("image") != null){
                $blog->image = url('/images/blogs/')."/".$fileName;
            }
            
            $blog->update();

            return response()->json(["success" => true]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function fetch(){
        return response()->json(["blogs" => Blog::all()]);
    }

    function delete(Request $request){

        Blog::where("id", $request->id)->first()->delete();
        return response()->json(["success" => true]);

    }

}
