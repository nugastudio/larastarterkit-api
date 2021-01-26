<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return response(["status_code" => 401, "message" => "Providers unauthorized access token, client invalid"],401);
});

Route::get('/redirect/invalid-request', function () {
    // return view('welcome');
    return response(["status_code" => 400, "message" => "Invalid request REST Header Accept must be Application/json"],400);
});
