<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ArticleController extends Controller
{
    public function index()
    {
        $data = Article::orderBy('date', 'desc')->paginate(12);
        return response()->json($data);
    }

    public function find(Request $request){
        $data = Article::find($request->articleId);
        if(!$data){
        	return response()->json('error', 400);
		}
        return response()->json($data);
    }
    
    public function all(){
    	$data = Article::all();
    	
    	return response()->json($data);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25',
            'description' => 'required',
            'category' => 'required',
			'img' => 'required',
			'address' => 'required',
			'city' => 'required',
        ]);

        if($validator->fails()) {
			return response()->json(['message' => $validator->errors()->all()], "422");
        }
	
        $img = '../storage/' . $request->file('img')->store('uploads', 'public');
	
		$article = Article::create([
            'name' => $request->name,
            'description' => $request->description,
            'img' => $img,
            'price' => $request->price,
            'category' => $request->category,
			'date' => Carbon::now(),
			'address' => $request->address,
			'city' => $request->city,
        ]);

        $article->user()->associate($user->id);
        $article->save();
        
        return response()->json('ok', 200);
    }

    public function user(Request $request){
		$data = Article::find($request->articleId)->user;
		
		return response()->json($data);
	}
	
	public function comments(Request $request){
		$data = Article::find($request->articleId)->comment;
    	
    	return response()->json($data);
	}
	
	public function remove(Request $request){
    	$user = Auth::user();
    	
    	$article = Article::find($request->articleId);
    	
    	if ($user->id != $article->user_id){
    		return response()->json('err', 403);
		}
  
    	$article->delete();
    	
    	return ($article == true)? response()->json('ok', 200): response()->json(['message' => 'error'], 403);
	}
	
	public function update(Request $request){
    	$article = Article::find($request->articleId);
		
		$attrs = $request->all();
		$article->update($attrs);
		
		return ($article == true) ? response()->json($data = true, 200):
			response()->json($data = false, 403);
	}
	
	public function filter(Request $request){
    	$article = Article::query();
    	
    	if ($request->name){
    		$article->where('name', 'like', '%'.$request->name.'%')->get();
		}
    	
    	if ($request->price){
			$article->where('price', '<', $request->price)->get();
		}
		
		if ($request->category){
			$article->whereIn('category', $request->category)->get();
		}
		
		if ($request->city){
			$article->where('city', $request->city)->get();
		}
		
		$data = $article->orderBy('date', 'desc')->paginate(12);
	
    	if (!$data){
    		return response()->json('err', 403);
 		}
    	
    	return response()->json($data);
    }
}
