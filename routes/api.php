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
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('organs.institutions', 'Api\InstitutionController',  ['only' => [
    	'index'
]]);

Route::resource('institutions.subdivisions', 'Api\SubdivisionController',  ['only' => [
    	'index'
]]);

Route::resource('municipalities.cities', 'Api\CityController',  ['only' => [
    	'index', 'show'
]]);

Route::resource('preparation.application_methods', 'Api\ApplicationMethodController',  ['only' => [
    	'index', 'show'
]]);

Route::resource('diseases', 'Api\DiseaseController',  ['only' => [
    	'index', 'show'
]]);


Route::resource('subdivisions.municipalities', 'Api\MunicipalityController',  ['only' => [
    	'index', 'show'
]]);

Route::resource('subdivisions.preparation_receipts', 'Api\PreparationReceiptController',  ['only' => [
    	'index'
]]);

Route::resource('service.service_types', 'Api\ServiceTypeController',  ['only' => [
    	'index'
]]);

Route::resource('animal_types.agesexes', 'Api\AgesexController',  ['only' => [
    	'index', 'show'
]]);