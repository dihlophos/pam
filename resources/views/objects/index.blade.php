@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

@foreach ($objects as $id => $object)
    {{$object->organ->name}} > {{$object->institution->name}} > {{$object->subdivision->name}} > {{$object->name}}
@endforeach


@endsection
