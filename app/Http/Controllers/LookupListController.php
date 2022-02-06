<?php

namespace App\Http\Controllers;

use App\Models\LookupList;
use App\Traits\RESTActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LookupListController extends Controller
{
	const MODEL = "App\Models\LookupList";
	
	use RESTActions;
}
