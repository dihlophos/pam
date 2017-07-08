@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

{{$animals->links()}}
<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h1 class="panel-title pull-left" style="padding-top: 7.5px;">Животные объекта: {{ $object->name }}</h1>
        <a href="/object/{{ $object->id }}/animal/create" class="btn btn-default pull-right ">Добавить</a>
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <tr>
                    <th>Вид</th>
                    <th>Возраст</th>
                    <th>Количество</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
        @foreach ($animals as $animal)
                <tr>
                    <td>
                        <a href="/object/{{$animal->object_id}}/animal/{{$animal->id}}/edit">
                            {{ $animal->animalType->name }}
                        </a>
                    </td>
                    <td>
                        {{ $animal->age }}
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
    </div>
{{$animals->links()}}
</div>
@endsection
