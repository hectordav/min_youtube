<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model{
    protected $table='comments';

    /*relacion muchos a uno*/
	public function user(){
		return $this->belongsTo('App\User','user_id');
	}
	public function video(){
		return $this->belongsTo('App\video','video_id');
	}
}
