<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait RESTActions {
	
	protected $statusCodes = [
		'done' => 200,
		'created' => 201,
		'removed' => 204,
		'not_valid' => 400,
		'not_found' => 404,
		'conflict' => 409,
		'permissions' => 401
	];
	
	public function all(): JsonResponse
	{
		$modelClass = self::MODEL;
		return $this->respond('done', $modelClass::all());
	}
	
	public function get($id): JsonResponse
	{
		$modelClass = self::MODEL;
		$model = $modelClass::find($id);
		if(is_null($model)){
			return $this->respond('not_found');
		}
		return $this->respond('done', $model);
	}
	
	public function add(Request $request): JsonResponse
	{
		$modelClass = self::MODEL;
		$this->validate($request, $modelClass::$rules);
		return $this->respond('created', $modelClass::create($request->all()));
	}
	
	public function put(Request $request, $id): JsonResponse
	{
		$modelClass = self::MODEL;
		$this->validate($request, $modelClass::$rules);
		$model = $modelClass::find($id);
		if(is_null($model)){
			return $this->respond('not_found');
		}
		$model->update($request->all());
		return $this->respond('done', $model);
	}
	
	public function remove($id): JsonResponse
	{
		$modelClass = self::MODEL;
		if(is_null($modelClass::find($id))){
			return $this->respond('not_found');
		}
		$modelClass::destroy($id);
		return $this->respond('removed');
	}
	
	protected function respond($status, $data = []): JsonResponse
	{
		return response()->json($data, $this->statusCodes[$status]);
	}
	
}
