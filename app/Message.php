<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = [
		'user', 'author', 'messages', 'status', 'lastMessage'
	];
	
	public function user(){
		return $this->belongsTo('App\User', 'author');
	}
	
	protected $casts  = [
		'messages' => 'array',
	];
}
