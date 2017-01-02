<?php

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
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => 'auth'], function () {

    Route::get('/home',
        ['as' => 'home',
        'uses' => 'HomeController@index']);

    Route::group(
    	['middleware' => 'can:access-lists',
    	'prefix' => 'lists'],
    	function () {
    		Route::get('/',
    			['as' => 'lists-index',
    			'uses' => function() { return view('lists/lists'); }]);
    		Route::resource('/disease_type', 'DiseaseTypeController');
			Route::resource('/disease', 'DiseaseController');
            Route::resource('/animal_category', 'AnimalCategoryController');
            Route::resource('/animal_type', 'AnimalTypeController');
    	}
    );

});
