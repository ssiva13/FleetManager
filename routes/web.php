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
		$router->get('llist', 'LookupListController@all');
		$router->get('llist/{id}', 'LookupListController@get');
		$router->post('llist', 'LookupListController@add');
		$router->put('llist/{id}', 'LookupListController@put');
		$router->delete('llist/{id}', 'LookupListController@remove');
		$router->post('llist/batchDelete', 'LookupListController@BatchDelete');
	});
