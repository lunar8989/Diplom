<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
    	$data = User::all();

    	return response()->json($data);
	}

	public function find(Request $request){
        $data = User::find($request->id);
        
        return response()->json($data);
    }
	
	public function show(Request $request){
		$data = User::where('email', $request->email);
		
		return response()->json($data);
	}
}
