<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\HomeVideo;

class VideoController extends Controller
{
    
    function index(){

        $homeVideo = HomeVideo::first();

        return view("videos.index", ["homeVideo" => $homeVideo]);
    }

    function update(Request $request){

        ini_set('max_execution_time', 0);

        try{

            if($request->get("video") != null){
                
                $videoData = $request->get('video');
               
                if(explode('/', explode(':', substr($videoData, 0, strpos($videoData, ';')))[1])[0] == "video"){
                    
                    $data = explode( ',', $videoData);
                    $fileVideo = Carbon::now()->timestamp . '_' . uniqid() . '.'.explode('/', explode(':', substr($videoData, 0, strpos($videoData, ';')))[1])[1];
                    $ifp = fopen($fileVideo, 'wb' );
                    fwrite($ifp, base64_decode( $data[1] ) );
                    rename($fileVideo, 'images/'.$fileVideo);
                }

            }

            $home = HomeVideo::first();
            if($request->get("video") != null){
                $home->video = url('images/').'/'.$fileVideo; 
            }
            $home->active = $request->active;
            $home->update();

            return response()->json(["success" => true, "msg" => "Video actualizado"]);

        }catch(\Exception $e){

            return response()->json(["success" => true, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }



}
