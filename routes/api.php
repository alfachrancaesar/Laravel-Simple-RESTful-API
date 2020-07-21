<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace'=>'App\Http\Controllers\API'], function($api) {

	//end-point for guest
	$api->post('login', 'APIAuthController@login');
});

$api->version('v1', ['middleware'=>'jwt.auth', 'namespace' => 'App\Http\Controllers\API'], function($api) {

	//end-point for user
	$api->get('users', 'APIUserController@index'); //method GET
	$api->post('users', 'APIUserController@store'); //method POST
	$api->put('users/{id}', 'APIUserController@update'); //method PUT
	$api->delete('users/{id}', 'APIUserController@delete'); //method DELETE
	$api->post('logout', 'APIAuthController@logout'); 

});
