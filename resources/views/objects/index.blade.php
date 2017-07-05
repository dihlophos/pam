@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

{{$objects->links()}}
@foreach ($organs as $name => $organ)
    <ul class="pem-tree">
        <li>
            <p><span>{{$name}} ({{$organ['id']}})</span><font>Препараты | Факт | План | Сведения о животных | Отчеты</font></p>
            <ul>
            @foreach ($organ['institutions'] as $name => $institution)
                <li>
                    <p><span>{{$name}} ({{$institution['id']}})</span><font>Препараты | Факт | План | Сведения о животных | Отчеты</font></p>
                    <ul>
                    @foreach ($institution['subdivisions'] as $name => $subdivision)
                        <li>
                            <p>
                                <span>{{$name}} ({{$subdivision['id']}})</span>
                                <font>
                                    <a href="subdivision/{{ $subdivision['id'] }}/preparation_receipt">Препараты</a> | Факт | План | Сведения о животных | Отчеты
                                </font>
                                </p>
                            <ul>
                                <li><a href="/object/create?subdivision={{ $subdivision['id'] }}">Добавить объект</a></li>
                            @foreach ($subdivision['objects'] as $object)
                                <li>
                                    <p>
                                        <span>
                                            <a href="/object/{{ $object->id }}/edit">{{$object->name}}</a>
                                        </span>
                                        <font>
                                            Факт | План | <a href="object/{{ $object->id }}/animal">Сведения о животных</a> | Отчеты
                                        </font>
                                    </p>
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
