<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Video;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $videos=Video::orderBy('id','desc')->paginate(5); /*colocamos Video porque eso esta definido en el modelo de videos OJO*/
        $data = array('videos' =>$videos);
        return view('home',$data);
    }

}
