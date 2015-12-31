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

use Illuminate\Http\Request;

$app->get('/', function () use ($app) {
    return $app->welcome();
});

$app->get('/box/{name}', function ($name) use ($app) {
    return app('cache')->store('file')->get($name);
});

$app->post('/box/{name}', function ($name, Request $request) use ($app) {
    app('cache')->store('file')->forever($name, $request->all());
    return $request->all();
});

$app->delete('/box/{name}', function ($name) use ($app) {
    app('cache')->store('file')->forget($name);
    return response("Deleted", 204);
});