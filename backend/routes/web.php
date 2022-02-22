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
    return "laas";
});

$router->get('/test', function () use ($router) {
    return $_ENV;
});

$router->get('/calander/{uid}', 'Api@getschedule');

$router->post('/getuid', 'Api@getuid');

$router->post('/login', 'Api@login');