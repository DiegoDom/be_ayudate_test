<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('users', ['as' => 'users.store', 'uses' => 'AuthController@register']);
$router->post('login', ['as' => 'users.login', 'uses' => 'AuthController@login']);

$router->group(['middleware' => 'auth'], function() use ($router) {
    $router->get('profiles', ['as' => 'directorios', 'uses' => 'ProfileController@index']);
    $router->get('profiles/{id}', ['as' => 'directorios.show', 'uses' => 'ProfileController@show']);
    $router->post('profiles', ['as' => 'profiles.store', 'uses' => 'ProfileController@store']);
    $router->post('profiles/{id}', ['as' => 'profiles.update', 'uses' => 'ProfileController@update']);
    $router->delete('profiles/{id}', ['as' => 'profiles.delete', 'uses' => 'ProfileController@delete']);

    $router->post('logout', ['as' => 'users.logout', 'uses' => 'AuthController@logout']);
});
