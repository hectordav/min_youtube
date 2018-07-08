<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Video;    /*los modelos*/
use App\Comment;	/*los modelos*/
 

class VideoController extends Controller{
    
    public function createVideo($value=''){
    	return view('video.createVideo');
    }
    public function saveVideo(Request $request){
    	/* validar formularios*/
    	$validateData=$this->validate($request,
    		[ 'title' =>'required|min:5',
    		'description' =>'required',
    		'video' =>'mimes:mp4',
    		]);
    	$video=New Video();
    	$user= \Auth::user();
    	$video->user_id=$user->id;
    	$video->title	=$request->input('title');
    	$video->description	=$request->input('description');

    	/*subida de la miniatura*/
    	$image=$request->file('image');
    	if ($image) {
    		$image_path= $image->getClientOriginalName();
    		Storage::disk('images')->put($image_path,\File::get($image));
    			$video->image=$image_path;
    	}
    	/**************************************************************/
    	/* subida del video*/
    	
        $video_file=$request->file('video');
        if ($video_file) {
            $video_path= $video_file->getClientOriginalName();
            Storage::disk('videos')->put($video_path,\File::get($video_file));
                $video->video_path=$video_path;
        }
        /**************************************************************/

    	$video->save();
    	return redirect()->route('home')->with(array('message' =>'El video se ha subido correctamente'));
    }
    public function getImage($filename){
        $file=Storage::disk('images')->get($filename);
        return new Response($file,200);
        /*return \Response::json($file);*/   
    }
    public function getVideoDetail($video_id){
        $video=Video::find($video_id); /*para buscar un elemento con el id en el modelo video*/
        $data = array('video' =>$video);
        return view('video.detail',$data);
    }
    public function getVideo($filename){
        $file=Storage::disk('videos')->get($filename);
        return new Response($file,200);
    }
    public function delete($video_id){
        $user=\Auth::user();  /*para tomar la autentificacion ojo*/
        $video=Video::find($video_id);
        $comments=Comment::where('video_id',$video_id)->get();
        if ($user && $video->user_id==$user->id ) {
            if ($comments && count($comments)>=1) {
               foreach ($comments as $key) {
                    $key->delete();
               }
            }
            /*eliminar ficheros*/
            Storage::disk('images')->delete($video->image);
            Storage::disk('videos')->delete($video->video_path);
            $video->delete();
            $data = array('message' =>'El video se ha borrado correctamente');
        }else{
            $data = array('message' =>'NO SE ELIMINAO');    
        }
        return redirect()->route('home')->with($data);
    }
    public function edit($video_id){
        $user=\Auth::user();  /*para tomar la autentificacion ojo*/
        $video=Video::findOrFail($video_id);

        if ($user && $video->user_id==$user->id ) {
            $data = array('video' =>$video);
            return view('video.edit',$data);
        }else{
           $data = array('message' =>'No tienes privilegios');
           return redirect()->route('home')->with($data);
        }
    }
    public function update($video_id, request $request){
      $validateData=$this->validate($request,
        [ 'title' =>'required|min:5',
        'description' =>'required',
        'miniatura' =>'image',
        'video' =>'mimes:mp4',
        ]);
      $video=Video::findOrFail($video_id);
      $user=\Auth::user();  /*para tomar la autentificacion ojo*/
      $video->user_id=$user->id;
      $video->title=$request->input('title');
      $video->description=$request->input('description');
      /*subida de la miniatura*/
      $image=$request->file('image');
      if ($image) {
        $image_path= time().$image->getClientOriginalName();
        Storage::disk('images')->put($image_path,\File::get($image));
        $video->image=$image_path;
      }
      /**************************************************************/
      /* subida del video*/
      
        $video_file=$request->file('video');
        if ($video_file) {  
            $video_path= time().$video_file->getClientOriginalName();
            Storage::disk('videos')->put($video_path,\File::get($video_file));
            Storage::disk('videos')->delete($video->video_path);
            $video->video_path=$video_path;
        }
        /**************************************************************/
        $video->update();
        $data = array('message' =>'Video Actualizado');
         return redirect()->route('home')->with($data);
    }
    public function search($search=null,$filter=null){
      if (is_null($search)) {
        $search=\Request::get('search');
        $data = array('search' =>$search);
         return redirect()->route('videoSearch',$data);
      }
      if (is_null($filter) && \Request::get('filter') && !is_null($search) ) {
        $filter=\Request::get('filter');
        $data = array('search' =>$search,
          'filter' =>$filter);
         return redirect()->route('videoSearch',$data);
      }
      $columna='id';
      $order='desc';
      if (!is_null($filter)) {
        if ($filter=='new') {
          $columna='id';
          $order='desc';
        }
        if ($filter=='old') {
          $columna='id';
          $order='asc';
        }
        if ($filter=='alfa') {
          $columna='title';
          $order='asc';
        }
      }
      $videos=Video::where('title','LIKE','%'.$search.'%')->orderBy($columna,$order)->paginate(5);
      $data = array('videos' =>$videos,
      'search' =>$search);
      return view('video.search',$data);
    }

}
