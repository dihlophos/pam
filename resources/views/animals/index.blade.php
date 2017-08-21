@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h1 class="panel-title pull-left" style="padding-top: 7.5px;">{{ $object->name }} > Групповой учет</h1>
        <a href="/object/{{ $object->id }}/animal/create" class="btn btn-default pull-right ">Добавить</a>
    </div>
    <div class="panel-body">
        {{$animal_groups->appends('individuals_page', request('individuals_page'))->links()}}
        <table class="table table-striped task-table">
            <thead>
                <tr>
                    <th>Вид</th>
                    <th>Половозрастная группа</th>
                    <th>Количество</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
        @foreach ($animal_groups as $animal)
                <tr>
                    <td>
                        <a href="/object/{{$animal->object_id}}/animal/{{$animal->id}}/edit">
                            {{ $animal->animalType->name }}
                        </a>
                    </td>
                    <td>
                        {{ $animal->agesex->name }}
                    </td>
                    <td>
                        {{ $animal->count }}
                    </td>
                    <td>
                        <form action="/object/{{ $animal->object_id }}/animal/{{ $animal->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button class="btn btn-primary">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
        @endforeach
            </tbody>
        </table>
        {{$animal_groups->appends('individuals_page', request('individuals_page'))->links()}}
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h1 class="panel-title pull-left" style="padding-top: 7.5px;">{{ $object->name }} > Индивидуальный учет</h1>
        <a href="/object/{{ $object->id }}/animal/create" class="btn btn-default pull-right ">Добавить</a>
    </div>
    <div class="panel-body">
        {{$animal_individuals->appends('groups_page', request('groups_page'))->links()}}
        <table class="table table-striped task-table">
            <thead>
                <tr>
                    <th>Вид</th>
                    <th>Половозрастная группа</th>
                    <th>Кличка</th>
                    <th>Пол, порода, окрас, особые приметы</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
        @foreach ($animal_individuals as $animal)
                <tr>
                    <td>
                        <a href="/object/{{$animal->object_id}}/animal/{{$animal->id}}/edit">
                            {{ $animal->animalType->name }}
                        </a>
                    </td>
                    <td>
                        {{ $animal->agesex? $animal->agesex->name : '' }}
                    </td>
                    <td>
                        {{ $animal->name }}
                    </td>
                    <td>
                        {{ $animal->marks }}
                    </td>
                    <td>
                        <form action="/object/{{ $animal->object_id }}/animal/{{ $animal->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button class="btn btn-primary">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
        @endforeach
            </tbody>
        </table>
        {{$animal_individuals->appends('groups_page', request('groups_page'))->links()}}
    </div>
</div>
@endsection
