<?php

namespace App\Http\Controllers;

use App\Models\MetaUser;
use App\Models\User;
use App\Traits\RESTActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
	const MODEL = "App\\Models\\User";
	
	use RESTActions;
	
	
	/**
	 * Get the authenticated User.
	 *
	 * @return JsonResponse
	 */
	public function profile(): JsonResponse
	{
		$user = auth()->user();
		$meta = $user->metaUsers;
		return $this->respond('done', $user);
	}
	
	/**
	 * @return JsonResponse
	 */
	public function index(): JsonResponse
	{
		$modelClass = self::MODEL;
		$models = $modelClass::with('metaUsers')->get();
		return $this->respond('done', $models);
	}
	
	public function all(): JsonResponse
	{
		$modelClass = self::MODEL;
		$models = $modelClass::withTrashed()->with('metaUsers')->get();
		return $this->respond('done', $models);
	}
	public function trashed(): JsonResponse
	{
		$modelClass = self::MODEL;
		$models = $modelClass::onlyTrashed()->with('metaUsers')->get();
		return $this->respond('done', $models);
	}
	public function get($id): JsonResponse
	{
		$modelClass = self::MODEL;
		$model = $modelClass::with('metaUsers')->find($id);
		if(is_null($model)){
			return $this->respond('not_found', ['message' => "No query results for model [{$modelClass}] with id [{$id}]"]);
		}
		return $this->respond('done', $model);
	}
	
	public function put(Request $request, $id): JsonResponse
	{
		$modelClass = self::MODEL;
		$this->validate($request, User::rules(), User::messages());
		
		if(!is_null($model = User::find($id))){
			$model::update($request->all());
//			$model->push();
			$metaUser = $model->metaUsers;
			$metaUser->update($request->all());
			return $this->respond('done', $model);
		}
		return $this->respond('not_found', ['message' => "No query results for model [{$modelClass}] with id [{$id}]"]);
	}
	
	public function delete($id): JsonResponse
	{
		$modelClass = self::MODEL;
		if(!is_null($model = $modelClass::find($id))){
			$model->delete();
			$model->push();
			return $this->respond('removed', $model);
		}
		return $this->respond('not_found', ['message' => "No query results for model [{$modelClass}] with id [{$id}]"]);
	}
	
	
}
