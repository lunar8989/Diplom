<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;


class MessageController extends Controller
{
	public function create(Request $request){
		$user = Auth::user();
		
		$validator = Validator::make($request->all(), [
			'message' => 'required',
			'user' => 'required',
			'lastMessage' => 'required',
		]);
		
		if($validator->fails()) {
			return response()->json(['message' => $validator->errors()->all()], "422");
		}
		
		$chat = User::find($user->id)->message;
		foreach ($chat as $message){
			if ($message['author'] == $request->user){
				return $this->update($request);
			}
		}
		
		$message = Message::create([
			'messages' => $request->message,
			'user' => $request->user,
			'status' => true,
			'author' => $user->id,
			'lastMessage' => $request->lastMessage,
		]);
		
		$message->user()->associate($user->id);
		$message->save();
		
		return response()->json('ok', 200);
	}
	
	public function update(Request $request)
	{
		$chat = Message::find($request->id);
		
		$attrs = $request->all();
		$chat->update($attrs);
		
		return ($chat == true) ? response()->json($data = true, 200) :
			response()->json($data = false, 403);
		
	}
	
	public function getMessagesForChat(Request $request){
		
		$messages = Message::find($request->id);
		
		return ($messages) ? response()->json($messages) : response()->json('error', 422);
	}
}
