<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
    	$users = User::all();

    	return response()->json($users);
	}

	public function find(Request $request){
        $data = User::find($request->id);
        return response()->json($data);
    }
}
