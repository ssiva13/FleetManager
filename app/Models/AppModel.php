<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\SoftDeletes;
	use Illuminate\Support\Arr;
	
	class AppModel extends Model
	{
		use SoftDeletes;
		
		/**
		 * @var mixed
		 */
		private $defaultFillable = ['created_at', 'updated_at', 'deleted_at'];
	}