<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
	
	/**
	 * Register a new user
	 */
	
//	public function register(Request $request)
//	{
//		$v = Validator::make($request->all(), [
//			'name' => 'required|min:3',
//			'phone' => 'required|min:9',
//			'email' => 'required|email|unique:users',
//			'password'  => 'required|min:3|confirmed',
//		]);
//		if ($v->fails())
//		{
//			return response()->json([
//				'status' => 'error',
//				'errors' => $v->errors()
//			], 422);
//		}
//
//		$user = User::create([
//			'name' => $request->name,
//			'email' => $request->email,
//			'phone' => $request->phone,
//			'password' => Hash::make($request->password),
//		]);
//
////		$user->name = $request->name;
////		$user->phone = $request->phone;
////		$user->email = $request->email;
////		$user->password = bcrypt($request->password);
//		$user->save();
//		return response()->json(['status' => 'success'], 200);
//	}
	/**
	 * Login user and return a token
	 */
//
	
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login']]);
	}
	
	/**
	 * Get a JWT via given credentials.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login()
	{
		$credentials = request(['email', 'password']);
		
		if (! $token = auth()->attempt($credentials)) {
			return response()->json(['error' => 'Unauthorized'], 401);
		}
		
		return $this->respondWithToken($token);
	}
	
	/**
	 * Get the authenticated User.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me()
	{
		return response()->json(auth()->user());
	}
	
	
	/**
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function refresh()
	{
		return $this->respondWithToken(auth()->refresh());
	}
	
	/**
	 * Log the user out (Invalidate the token).
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		auth()->logout();
		
		return response()->json(['message' => 'Successfully logged out']);
	}
	
	/**
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	
	/**
	 * Get the token array structure.
	 *
	 * @param  string $token
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function respondWithToken($token)
	{
		return response()->json([
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' => auth()->factory()->getTTL() * 60
		])->header('Authorization', $token);
		
	
	}

}
