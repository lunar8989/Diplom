<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
    	$data = User::all();

    	return response()->json($data);
	}
	
	public function auth(){
    	$data = Auth::user();
    	
    	return response()->json($data);
	}

	public function find(Request $request){
        $data = User::find($request->userId);
        
        return response()->json($data);
    }
	
	public function show(Request $request){
		$data = User::where('email', $request->email)->first();
		
		return response()->json($data);
	}
	
	public function article(Request $request){
    	$data = User::find($request->userId)->article;
    	
    	if (!$data){
    		return response()->json('error', 403);
		}
    	
    	return response()->json($data);
    }
    
    public function update(Request $request){
    	$user = User::find($request->userId);
    	
    	if (!$request->img){
    		return response()->json($data = false, 403);
		}
  
		$img = '../storage/' . $request->file('img')->store('uploads', 'public');
		
		$user->update([
			'img' => $img,
			'name' => $request->name,
			'phone' => $request->phone,
		]);
	
		return ($user == true) ? response()->json($data = true, 200):
			response()->json($data = false, 403);
	}
	
	public function getMessages(Request $request){
		$messages = User::find($request->userId)->message;
		
		foreach ($messages as $message){
			$author = User::find($message['author']);
			$message['authorName'] = $author['name'];
		}
		
		if (!$messages){
			return response()->json('error', 403);
		}
		
		return response()->json($messages);
	}
}
