<?php

$router->get('/', function () use ($router) {
    return response()->json([
        "code" => 200,
        "message" => "OK",
        "data"    => [
            "project" => "Deweloper",
            "framework_version" => $router->app->version(),
            "creator" => "Ahmad Shobirin"
        ],
    ], 200);
});

$router->get('creations', 'CreationsController@index');

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/me','AuthController@me');
        $router->post('/logout','AuthController@logout');

        // $router->get('creations', 'CreationsController@index');
    });
});