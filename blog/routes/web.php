<?php
require_once "../lib/getavailability.php";
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

$router->get('/calander', function () use ($router) {
    return getavailability("493c74795eb74003a54f8eb7e618f65f08f41a0712b6407f812a4ee79c3af7b5");
});
