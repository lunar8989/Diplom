<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $fillable = [
        'name', 'img',
    ];

    public function article(){
        return $this->hasMany('App\Article');
    }
}
