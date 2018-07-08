<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\User;    /*los modelos*/
use App\Video;    /*los modelos*/
use App\Comment;	/*los modelos*/

class UserController extends Controller{
    public function channel($user_id){
    	$user=User::find($user_id);
    	if (!is_object($user)) {
    		 return redirect()->route('home');
    	}
    	$videos=Video::where('user_id',$user_id)->paginate(5);

    	$data = array('user' =>$user,
    		'videos' =>$videos
    	 );
    	return view('user.channel',$data);

    	
    }
}
