<?php

/** @var Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
	
	use Laravel\Lumen\Routing\Router;
	
	$router->get('/', 'HomeController@home');
	$router->group(['prefix' => 'admin/'], function () use ($router) {
		// Start Routes for resource llist
		$router->group(['middleware' => 'auth:api',], function () use ($router) {
			$router->get('llist/index', 'LookupListController@index');
			$router->get('llist/all', 'LookupListController@all');
			$router->get('llist/trashed', 'LookupListController@trashed');
			$router->get('llist/{id}', 'LookupListController@get');
			$router->post('llist', 'LookupListController@add');
			$router->put('llist/{id}', 'LookupListController@put');
			$router->delete('llist/{id}', 'LookupListController@remove');
			$router->post('llist/{id}', 'LookupListController@forceDelete');
		});
		// End Routes for resource llist
		
		// Start Routes for resource lvalues
		$router->group(['middleware' => 'auth:api',], function () use ($router) {
			$router->get('lvalues/index', 'LookupValueController@index');
			$router->get('lvalues/all', 'LookupValueController@all');
			$router->get('lvalues/trashed', 'LookupValueController@trashed');
			$router->get('lvalues/{id}', 'LookupValueController@get');
			$router->post('lvalues', 'LookupValueController@add');
			$router->put('lvalues/{id}', 'LookupValueController@put');
			$router->delete('lvalues/{id}', 'LookupValueController@remove');
			$router->post('lvalues/{id}', 'LookupValueController@forceDelete');
		});
		// End Routes for resource lvalues
		
		// auth routes
		$router->group(['prefix' => 'api'], function () use ($router) {
			$router->post('register', 'AuthController@register');
			$router->post('login', 'AuthController@login');
			$router->get('refresh', 'AuthController@refresh');
			$router->get('profile', 'AuthController@profile');
			$router->get('users/{id}', 'UserController@singleUser');
			$router->get('users', 'UserController@allUsers');
		});

	});

	