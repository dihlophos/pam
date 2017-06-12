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

Route::post('/github',
    ['middleware' => 'github.secret.token',
    'uses' => 'GitHubController@post']);
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
    		Route::resource('/disease_type', 'DiseaseTypeController', ['except' => [
                'create', 'show', 'edit'
            ]]);
			Route::resource('/disease', 'DiseaseController', ['except' => [
                'create', 'show'
            ]]);
            Route::post('/disease/{id}/add_service', 'DiseaseController@add_service');//Че так не рестфул? https://laravel.com/docs/5.1/controllers#restful-nested-resources
                                                                                      //из-за одного лишь добавления/удаления записей многие ко многим создавать контрллер с 2мя методами
                                                                                      //показалось старнным. Кстати почему из поздних инструкций убрали эту секцию?)
            Route::delete('/disease/{id}/destroy_service/{service_id}', 'DiseaseController@destroy_service');//Че так не рестфул? https://laravel.com/docs/5.1/controllers#restful-nested-resources
            Route::resource('/animal_category', 'AnimalCategoryController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/animal_type', 'AnimalTypeController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/service_category', 'ServiceCategoryController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/measure', 'MeasureController');
            Route::resource('/preparation_measure', 'PreparationMeasureController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/basic_document', 'BasicDocumentController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/lab_jurisdiction', 'LabJurisdictionController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/executor', 'ExecutorController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/executor_category', 'ExecutorCategoryController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/material_type', 'MaterialTypeController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/research_category', 'ResearchCategoryController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/so_measure', 'SOMeasureController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/work_type', 'WorkTypeController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/service', 'ServiceController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/application_method', 'ApplicationMethodController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/preparation', 'PreparationController', ['except' => [
                'create', 'show'
            ]]);
            Route::resource('/region', 'RegionController', ['except' => [
                'create', 'show'
            ]]);
            Route::resource('/district', 'DistrictController', ['except' => [
                'create', 'show', 'index'
            ]]);
            Route::resource('/municipality', 'MunicipalityController', ['except' => [
                'create', 'show', 'index'
            ]]);
            Route::resource('/city', 'CityController', ['except' => [
                'create', 'show', 'edit', 'index'
            ]]);
            Route::resource('/organ', 'OrganController', ['except' => [
                'create', 'show'
            ]]);
    	}
    );

});
