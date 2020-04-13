<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function send(Request $request){
//		$validator = Validator::make($request->all(), [
//			'email' => 'required',
//			'userEmail' => 'required',
//		]);
//
//		if($validator->fails()) {
//			return response()->json(['message' => $validator->errors()->all()], "422");
//		}
    	
    	Mail::send(['text' => 'mail'], ['name', 'Дай лапу'], function ($message){
    		$message->to('vitaminka027@gmail.com', 'To you')->subject('Объявление');
    		$message->from('vitaminka027@gmail.com', 'По поводу объявления');
		});
    	
    	return response()->json('ok');
	}
}
