@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')
    <h1>Справочники</h1>
    <ul>
        <li><a href="{{ URL::action('UserController@index') }}">Пользователи</a></li>
        <li><a href="{{ URL::action('OrganController@index') }}">Органы/учреждения/подразделения</a></li>
        <li><a href="{{ URL::action('RegionController@index') }}">Регионы/районы/муниципальные образования/населенные пункты</a></li>
        <li><a href="{{ URL::action('DiseaseTypeController@index') }}">Виды болезней</a></li>
        <li><a href="{{ URL::action('DiseaseController@index') }}">Болезни</a></li>
        <li><a href="{{ URL::action('MeasureController@index') }}">Единицы учета</a></li>
        <li><a href="{{ URL::action('ServiceCategoryController@index') }}">Категории услуг</a></li>
        <li><a href="{{ URL::action('ServiceController@index') }}">Услуги</a></li>
        <li><a href="{{ URL::action('ServiceTypeController@index') }}">Виды услуг</a></li>
        <li><a href="{{ URL::action('PreparationController@index') }}">Препараты</a></li>
        <li><a href="{{ URL::action('AnimalCategoryController@index') }}">Категории животных</a></li>
        <li><a href="{{ URL::action('AnimalTypeController@index') }}">Виды животных</a></li>
        <li><a href="{{ URL::action('AgesexController@index') }}">Половозрастные группы</a></li>
        <li><a href="{{ URL::action('BasicDocumentController@index') }}">Первичный документ</a></li>
        <li><a href="{{ URL::action('LabJurisdictionController@index') }}">Подведомственность лаборатории</a></li>
        <li><a href="{{ URL::action('ExecutorCategoryController@index') }}">Категория исполнителя</a></li>
        <li><a href="{{ URL::action('ExecutorController@index') }}">Исполнители</a></li>
        <li><a href="{{ URL::action('MaterialTypeController@index') }}">Виды материала</a></li>
        <li><a href="{{ URL::action('ResearchCategoryController@index') }}">Категории исследований</a></li>
        <li><a href="{{ URL::action('ResearchTypeController@index') }}">Виды исследований</a></li>
        <li><a href="{{ URL::action('SOMeasureController@index') }}">Единица измерения СО</a></li>
        <li><a href="{{ URL::action('WorkTypeController@index') }}">Виды работ</a></li>
        <li><a href="{{ URL::action('PreparationMeasureController@index') }}">Единица измерения ВП</a></li>
        <li><a href="{{ URL::action('ApplicationMethodController@index') }}">Порядок применения</a></li>
    </ul>
@endsection
