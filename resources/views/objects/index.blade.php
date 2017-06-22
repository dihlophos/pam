@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

{{$objects->links()}}
@foreach ($organs as $name => $organ)
    <ul style="width:80%">
        <li>
            {{$name}} ({{$organ['id']}})<span style="float:right">Препараты | Факт | План | Сведения о животных | Отчеты</span>
            <ul>
            @foreach ($organ['institutions'] as $name => $institution)
                <li>
                    {{$name}} ({{$institution['id']}})<span style="float:right">Препараты | Факт | План | Сведения о животных | Отчеты</span>
                    <ul>
                    @foreach ($institution['subdivisions'] as $name => $subdivision)
                        <li>
                            {{$name}} ({{$subdivision['id']}})<span style="float:right">Препараты | Факт | План | Сведения о животных | Отчеты</span>
                            <ul>
                                <li><a href="/object/create?subdivision={{ $subdivision['id'] }}">Добавить объект</a></li>
                            @foreach ($subdivision['objects'] as $object)
                                <li>
                                    {{$object->name}} ({{$object->id}})<span style="float:right">Препараты | Факт | План | Сведения о животных | Отчеты</span>
                                </li>
                            @endforeach
                            </ul>
                        </li>
                    @endforeach
                    </ul>
                </li>
            @endforeach
            <ul>
        </li>
    </ul>
@endforeach
{{$objects->links()}}

@endsection
