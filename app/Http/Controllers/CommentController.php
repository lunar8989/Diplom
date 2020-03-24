<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class CommentController extends Controller
{
    public function index(){

    }

    public function create(Request $request){
        $user = Auth::user();
        $article = $request->article_id;

        $valid = Validator::make($request->all(), [
            'value' => 'required|max:300',
        ]);

        if ($valid->fails()){
            return response()->json('error valid', 403);
        }

        $comment = Comment::create([
            'value' => $request->value,
			'date' => Carbon::now(),
        ]);

        $comment->user()->associate($user->id);
        $comment->article()->associate($article);
        $comment->save();
        
        return response()->json('Ok', 200);
    }
    
    public function find(Request $request){
    	$data = Comment::where('article_id', $request->id)->all();
    	
    	return response()->json($data);
	}
}
