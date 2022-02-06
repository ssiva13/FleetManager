<?php

namespace App\Http\Controllers;

use App\Models\MetaUser;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login']]);
	}
	
	/**
	 * Store a new user.
	 *
	 * @param Request $request
	 * @return JsonResponse
	 * @throws ValidationException
	 * @throws Exception
	 */
	public function register(Request $request): JsonResponse
	{
		$request->request->add(['username' => $this->generateUsername($request)]);
		$this->validate($request, User::rules(), User::messages());
		$request->request->add(['password' => $this->generatePasswordHash($request)]);
		try {
			DB::beginTransaction();
			$user = User::create($request->all());
			$request->request->add(['fk_user' => $user->id]);
			$metaUser = MetaUser::create($request->all());
			
			DB::commit();
			return response()->json(['user' => $user,'meta' => $metaUser, 'message' => 'CREATED'], 201);
			
		} catch (Exception $e) {
			DB::rollback();
			return response()->json(['message' => 'User Registration Failed with '. $e->getMessage() .' !'], $e->getCode());
		}
	}
	
	/**
	 * Get a JWT via given credentials.
	 *
	 * @param Request $request
	 * @return JsonResponse
	 * @throws ValidationException
	 */
	public function login(Request $request): JsonResponse
	{
		$this->validate($request, [
			'email' => 'required_without:username|string',
			'username' => 'required_without:email|string',
			'password' => 'required|string',
		]);
		$credentials = $request->only(['username', 'password']);
		if($request->input('email')){
			$credentials = $request->only(['email', 'password']);
		}
		if (! $token = auth()->attempt($credentials)) {
			return response()->json(['error' => 'Unauthorized'], 401);
		}
		return $this->respondWithToken($token);
	}
	
	/**
	 * Get the authenticated User.
	 *
	 * @return JsonResponse
	 */
	public function profile(): JsonResponse
	{
		return response()->json(auth()->user());
	}
	
	/**
	 * Log the user out (Invalidate the token).
	 *
	 * @return JsonResponse
	 */
	public function logout(): JsonResponse
	{
		auth()->logout();
		return response()->json(['message' => 'Successfully logged out']);
	}
	
	/**
	 * Refresh a token.
	 *
	 * @return JsonResponse
	 */
	public function refresh(): JsonResponse
	{
		return $this->respondWithToken(auth()->refresh());
	}
	
	/**
	 * Get the token array structure.
	 *
	 * @param string $token
	 *
	 * @return JsonResponse
	 */
	protected function respondWithToken(string $token): JsonResponse
	{
		return response()->json([
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' => auth()->factory()->getTTL() * 60
		]);
	}
	
	private function generateUsername(Request $request): string
	{
		$name_array = getStrAsArray($request->input('first_name') . ' ' . $request->input('last_name'));
		$username = $name_array[0][0].$name_array[1];
		if( $user = User::withTrashed()->where('username', $username)->first() ){
			$username = $name_array[1][0].$name_array[0];
		}
		if( $user = User::withTrashed()->where('username', $username)->first() ){
			$username = $name_array[1][0].$name_array[1];
		}
		if( $user = User::withTrashed()->where('username', $username)->first() ){
			$username = $name_array[0][0].$name_array[0];
		}
		if( $userCount = User::withTrashed()->where('username', $username)->count() ){
			$username = $name_array[0][0].$name_array[0].$userCount;
		}
		return $username;
	}
	
	private function generatePasswordHash(Request $request)
	{
		return app('hash')->make($request->input('password'));
	}
}
