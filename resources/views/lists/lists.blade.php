@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')
    <h1>Справочники</h1>
    <ul>
       <li><a href="{{ URL::action('DiseaseTypeController@index') }}">Виды болезней</a></li>
       <li><a href="{{ URL::action('DiseaseController@index') }}">Болезни</a></li>
       <li><a href="{{ URL::action('AnimalCategoryController@index') }}">Категории животных</a></li>
       <li><a href="{{ URL::action('AnimalTypeController@index') }}">Виды животных</a></li>
       <li><a href="{{ URL::action('ServiceCategoryController@index') }}">Категории услуг</a></li>
       <li><a href="{{ URL::action('MeasureController@index') }}">Единицы учета</a></li>
       <li><a href="{{ URL::action('BasicDocumentController@index') }}">Первичный документ</a></li>       
    </ul>
@endsection
