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
    $details = app('cache')->store('file')->get($name);
    if (!$details) {
        return response("Not found", 404);
    }
    return $details;
});

$app->get('/box/{name}/revision/{revision}', function ($name, $revision) use ($app) {
    $details = app('cache')->store('file')->get($name);
    if (!$details) {
        return response("Not found", 404);
    }
    if ($details['revision'] != $revision) {
        return $details;
    }
    return response(null, 204);
});

$app->post('/box/{name}', function ($name, Request $request) use ($app) {
    $details = $request->all();
    if (!array_key_exists("revision", $details)) {
        throw new Exception("No revision number set.");
    }
    app('cache')->store('file')->forever($name, $request->all());
    return;
});

$app->delete('/box/{name}', function ($name) use ($app) {
    app('cache')->store('file')->forget($name);
    return response("Deleted", 204);
});