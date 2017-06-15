<?php

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



$app->get('/', function () use ($app) {
    return $app->version();
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'cors'], function ($api) {
//$api->group(['middleware' => 'cors'], function ($api) {

// AUTH /////////////////////////////
$api->group(['prefix' => 'auth'], function ($api) {
    $api->get('/user', 'App\Api\V1\Controllers\AuthController@user');
    $api->post('/signin', 'App\Api\V1\Controllers\AuthController@signin');
    $api->post('/signup', 'App\Api\V1\Controllers\AuthController@signup');
});

// USERS ///////////////////////////
    $api->group(['middleware' => 'api.auth'], function ($api) {
        $api->get('/users/create', 'App\Api\V1\Controllers\UserController@create');
        $api->post('/users', 'App\Api\V1\Controllers\UserController@store');
        $api->put('/users/{id}', 'App\Api\V1\Controllers\UserController@update');
        $api->delete('/users/{id}', 'App\Api\V1\Controllers\UserController@destroy');

//        $api->get('/users/{id}', 'App\Api\V1\Controllers\UserController@show');
//        $api->get('/users', 'App\Api\V1\Controllers\UserController@index');

    });

    $api->get('/users/{id}', 'App\Api\V1\Controllers\UserController@show');
    $api->get('/users', 'App\Api\V1\Controllers\UserController@index');

// ROLES ///////////////////////////
    $api->group(['middleware' => 'api.auth'], function ($api) {
        $api->get('/roles/create', 'App\Api\V1\Controllers\RoleController@create');
        $api->post('/roles', 'App\Api\V1\Controllers\RoleController@store');
        $api->put('/roles/{id}', 'App\Api\V1\Controllers\RoleController@update');
        $api->delete('/roles/{id}', 'App\Api\V1\Controllers\RoleController@destroy');

//        $api->get('/roles', 'App\Api\V1\Controllers\RoleController@index');

    });

    $api->get('/roles', 'App\Api\V1\Controllers\RoleController@index');

//});
});
