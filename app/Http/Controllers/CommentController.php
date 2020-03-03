<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index(){

    }

    public function create(Request $request){
        $user = $request->user;
        $article = $request->article;

        $valid = Validator::make($request->all(), [
            'value' => 'required|max:300',
        ]);

        if ($valid->fails()){
            return response()->json('error valid', 401);
        }

        $comment = Comment::create([
            'value' => $request->value,
        ]);

        $comment->user()->associate($user);
        $comment->article()->associate($article);
        $comment->save();
    }
}
