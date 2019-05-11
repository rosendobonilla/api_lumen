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

//use Illuminate\Support\Str;

$router->post('/users/login', ['uses' => 'UsersController@getToken']);

$router->get('/users/login', function () {
    return redirect('/',302);
    //return response()->json(['error' => 'Peticion no permitida para navegadores web.'],406);
});


$router->get('/', function () use ($router) {
    //return $router->app->version();

    return response()->json(['info' => 'API de la Universidad Tecnologica de Puebla. Creada por Rosendo Bonilla Juarez.'],200);
});

/*$router->get('/key', function () {
    return Str::random(32);
});*/


//Migrado a dos middleware en lugar de comprobar isJson() en UsersController

$router->group(['middleware' => ['json','auth']], function () use ($router){
    $router->post('/users', ['uses' => 'UsersController@addUser']);
    $router->get('/users', ['uses' => 'UsersController@usersList']);
});





