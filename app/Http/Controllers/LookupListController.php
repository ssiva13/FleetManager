<?php

namespace App\Http\Controllers;

use App\Traits\RESTActions;
use Illuminate\Http\Request;

class LookupListController extends Controller
{
	const MODEL = "App\Models\LookupList";
	
	use RESTActions;
}
