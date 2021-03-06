<?php

use Illuminate\Support\Str;

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

$router->get('/home', function ()  {
    return Str::random(40);
});

$router->post('/register', ['as' => 'register', 'uses' => 'AuthController@register']);
$router->post('/login', ['as' => 'login', 'uses' => 'AuthController@login']);

$router->post('/response', 'ExampleController@response');