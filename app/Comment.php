<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'article_id', 'value', 'author_id', 'date',
    ];

    public function article(){
        return $this->belongsTo('App\Article');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
