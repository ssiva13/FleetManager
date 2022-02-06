<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Http\Request as LumenRequest;

trait RESTActions {
	
	protected array $statusCodes = [
		'done' => 200,
		'created' => 201,
		'removed' => 204,
		'not_valid' => 400,
		'not_found' => 404,
		'conflict' => 409,
		'permissions' => 401
	];
	
	/**
	 * @return JsonResponse
	 */
	public function index(): JsonResponse
	{
		$modelClass = self::MODEL;
		$models = $modelClass::get();
		return $this->respond('done', $models);
	}
	
	public function all(): JsonResponse
	{
		$modelClass = self::MODEL;
		$models = $modelClass::withTrashed()->get();
		return $this->respond('done', $models);
	}
	
	public function trashed(): JsonResponse
	{
		$modelClass = self::MODEL;
		$models = $modelClass::onlyTrashed()->get();
		return $this->respond('done', $models);
	}
	
	public function get($id): JsonResponse
	{
		$modelClass = self::MODEL;
		$model = $modelClass::find($id);
		if(is_null($model)){
			return $this->respond('not_found', ['message' => "No query results for model [{$modelClass}] with id [{$id}]"]);
		}
		return $this->respond('done', $model);
	}
	
	public function add(Request $request): JsonResponse
	{
		$modelClass = self::MODEL;
		$this->validate($request, $modelClass::rules(), $modelClass::messages());
		
		return $this->respond('created', $modelClass::create($request->all()));
	}
	
	public function put(Request $request, $id): JsonResponse
	{
		$modelClass = self::MODEL;
		$this->validate($request, $modelClass::rules(), $modelClass::messages());
		
		if(!is_null($model = $modelClass::find($id))){
			$model->update($request->all());
			return $this->respond('done', $model);
		}
		return $this->respond('not_found', ['message' => "No query results for model [{$modelClass}] with id [{$id}]"]);
	}
	
	public function delete($id): JsonResponse
	{
		$modelClass = self::MODEL;
		if(!is_null($model = $modelClass::find($id))){
			$model->delete();
			return $this->respond('removed', $model);
		}
		return $this->respond('not_found', ['message' => "No query results for model [{$modelClass}] with id [{$id}]"]);
	}
	
	public function forceDelete($id): JsonResponse
	{
		$modelClass = self::MODEL;
		if(!is_null($model = $modelClass::onlyTrashed()->find($id))){
			$model->forceDelete();
			return $this->respond('removed', $model);
		}
		return $this->respond('not_found', ['message' => "No query results for model [{$modelClass}] with id [{$id}]"]);
	}
	
	protected function respond($status, $data = []): JsonResponse
	{
		return response()->json($data, $this->statusCodes[$status]);
	}
	
}
