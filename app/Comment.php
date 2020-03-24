<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'article_id', 'value', 'user_id', 'date',
    ];

    public function article(){
        return $this->belongsTo('App\Article', 'article_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
