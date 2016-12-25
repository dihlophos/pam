@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')
    <h1>Справочники</h1>
    <ul>
       <li><a href="{{ URL::action('DiseaseTypeController@index') }}">Виды болезней</a></li>
       <li><a href="{{ URL::action('DiseaseController@index') }}">Болезни</a></li>
    </ul>
@endsection
