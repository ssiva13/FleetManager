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
	$router->group(['prefix' => 'admin/api'], function () use ($router) {
		$router->post('login', 'AuthController@login');
	});
	$router->group(['prefix' => 'admin/', 'middleware' => 'auth:api'], function () use ($router) {
		// Start Routes for resource llist
		$router->group(['prefix' => 'llist/',], function () use ($router) {
			$router->get('index', 'LookupListController@index');
			$router->get('all', 'LookupListController@all');
			$router->get('trashed', 'LookupListController@trashed');
			$router->get('{id}', 'LookupListController@get');
			$router->post('/', 'LookupListController@add');
			$router->put('{id}', 'LookupListController@put');
			$router->delete('{id}', 'LookupListController@remove');
			$router->post('{id}', 'LookupListController@forceDelete');
		});
		// End Routes for resource llist
		
		// Start Routes for resource lvalues
		$router->group(['prefix' => 'lvalues/',], function () use ($router) {
			$router->get('index', 'LookupValueController@index');
			$router->get('all', 'LookupValueController@all');
			$router->get('trashed', 'LookupValueController@trashed');
			$router->get('{id}', 'LookupValueController@get');
			$router->post('/', 'LookupValueController@add');
			$router->put('{id}', 'LookupValueController@put');
			$router->delete('{id}', 'LookupValueController@remove');
			$router->post('{id}', 'LookupValueController@forceDelete');
		});
		// End Routes for resource lvalues
		
		// Start Routes for resource user and auth
		$router->group(['prefix' => 'users/',], function () use ($router) {
			//auth ep
			$router->post('register', 'AuthController@register');
			$router->get('refresh', 'AuthController@refresh');
			$router->get('logout', 'AuthController@logout');
			
			// users ep
			$router->get('profile', 'UserController@profile');
			$router->get('index', 'UserController@index');
			$router->get('all', 'UserController@all');
			$router->get('trashed', 'UserController@trashed');
			$router->get('{id}', 'UserController@get');
			$router->put('{id}', 'UserController@put');
			$router->delete('{id}', 'UserController@remove');
			$router->post('{id}', 'UserController@forceDelete');

		});
		// End Routes for resource user

	});

	