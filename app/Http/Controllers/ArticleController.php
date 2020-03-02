<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $data = Article::paginate(12);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user;

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json("error", "401");
        }

        $article = Article::create([
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $request->img,
            'price' => $request->price,
            'category' => $request->category,
        ]);

        $article->user()->associate($user);
        $article->save();
    }
    
    public function show($id){
		$article = Article::where('id', $id)->first();
	
		if(!$article){
			return response()->json('',404);
		}
		
		return view('article', ['id' => $article->id]);
//		return redirect()->route('article', [$article->id]);
	}
    
    public function find($id){
    	$article = Article::where('id', $id)->first();
    	
    	if(!$article){
    		return response()->json('',404);
		}
    	
    	return response()->json($article);
	}
}
