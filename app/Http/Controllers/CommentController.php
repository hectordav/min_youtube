<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;	/*los modelos*/

class CommentController extends Controller{

    public function store(Request $request){
    	$validate=$this->validate($request,[
    		'body' =>'required'
    	]);
    	$comment=new Comment();  /*para poder utilizarlo ojo*/
    	$user=\Auth::user();  /*para tomar la autentificacion ojo*/
    	$comment->user_id=$user->id; 
    	$comment->video_id=$request->input('video_id');
    	$comment->body=$request->input('body');
    	$comment->save();
    	$data = array('video_id' =>$comment->video_id);
    	return redirect()->route('detailVideo',$data)->with(array('message' =>'Comentario Guardado'));
    }
    public function delete($comment_id){
    	$user=\Auth::user();  /*para tomar la autentificacion ojo*/
    	$comment=Comment::find($comment_id);
    	if ($user && ($comment->user_id==$user->id || $comment->video->user_id==$user->id) ) {
    		$comment->delete();
    	}
    	$data = array('video_id' =>$comment->video_id);
    	return redirect()->route('detailVideo',$data)->with(array('message' =>'Comentario Borrado'));
    }
}
