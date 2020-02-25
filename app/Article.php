<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price', 'category', 'img', 'date', 'author'
    ];

    public function categories(){
        return $this->belongsTo('App\categories');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
