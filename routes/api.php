<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

*/

Route::namespace('Api')->group(function () {
    Route::get('/menu', 'MenuController@index');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group(['middleware' => 'auth:api'], function() {

    Route::apiResources(
        [   'alumnos'   => 'Api\AlumnoController',
            'empresas'  => 'Api\EmpresaController',
            'ciclos'    =>'Api\CicloController'
        ],
        ['except' => ['destroy']]);
    Route::apiResources(
        [   'users' => 'Api\UserController',
            'ofertas' => 'Api\OfertaController',
        ]);
    Route::put('ofertas/{id}/validar','Api\OfertaController@Valida');
    Route::put('ofertas/{id}/alumno', 'Api\OfertaController@AlumnoInterested');
    // Modificada
    Route::put('alumnos/{alumno}/ciclo/{id}','Api\AlumnoController@ValidaCiclo')->name('alumnos.ciclo.update');
    Route::get('ofertas-arxiu', 'Api\OfertaController@indexArxiu');
});

Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});