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

Route::post('/github', 'GitHubController@post');
Route::get('/github', 'GitHubController@get');

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
            Route::post('/disease/{id}/add_service', 'DiseaseController@add_service');//Че так не рестфул? https://laravel.com/docs/5.1/controllers#restful-nested-resources
            Route::delete('/disease/{id}/destroy_service/{service_id}', 'DiseaseController@destroy_service');//Че так не рестфул? https://laravel.com/docs/5.1/controllers#restful-nested-resources
            Route::resource('/animal_category', 'AnimalCategoryController');
            Route::resource('/animal_type', 'AnimalTypeController');
            Route::resource('/service_category', 'ServiceCategoryController');
            Route::resource('/measure', 'MeasureController');
            Route::resource('/basic_document', 'BasicDocumentController');
            Route::resource('/lab_jurisdiction', 'LabJurisdictionController');
            Route::resource('/executor', 'ExecutorController');
            Route::resource('/executor_category', 'ExecutorCategoryController');
            Route::resource('/material_type', 'MaterialTypeController');
            Route::resource('/research_category', 'ResearchCategoryController');
            Route::resource('/so_measure', 'SOMeasureController');
            Route::resource('/work_type', 'WorkTypeController');
            Route::resource('/service', 'ServiceController');
    	}
    );

});
