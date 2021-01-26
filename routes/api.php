<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get("/", function(Request $request){
    // return $request->all();
    dd(__NAMESPACE__);
});
Route::post("/auth/v1/signin", "Authenticate\AuthController@signin");
Route::post("/auth/v1/register", "Authenticate\AuthController@register");
Route::group(["middleware" => ['auth:sanctum', 'role:admin']] , function () {
    Route::prefix('v1/admin')->group(function () {
        Route::get('/users', "Administration\UsersController@getUsers");

        // ROLES MANAGEMENTs
        Route::get('/roles', "Administration\RolesController@listRoleUsers");
    });
});

// Route::group([
//     'middleware'    => ['auth:api'],
//     'as'            => 'laravelroles::',
//     'namespace'     => 'jeremykenedy\LaravelRoles\App\Http\Controllers\Api',
//     'prefix'        => 'api',
// ], function () {
//     Route::apiResource('roles-api', 'LaravelRolesApiController');
// });
