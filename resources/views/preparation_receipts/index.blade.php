@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

{{$preparationReceipts->links()}}
<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h1 class="panel-title pull-left" style="padding-top: 7.5px;">Препараты подразделения: {{ $subdivision->name }}</h1>
        <a href="/subdivision/{{ $subdivision->id }}/preparation_receipt/create" class="btn btn-default pull-right ">Добавить</a>
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <thead>
                <tr>
                    <th>Дата записи</th>
                    <th>Код записи</th>
                </tr>
            </thead>
            <tbody>
        @foreach ($preparationReceipts as $preparationReceipt)
                <tr>
                    <td>{{$preparationReceipt->date}}</td>
                    <td>
                        <a href="/subdivision/{{$preparationReceipt->subdivision_id}}/preparation_receipt/{{$preparationReceipt->id}}/edit">
                            {{$preparationReceipt->id}}-{{$preparationReceipt->preparation->name}}
                        </a>
                    </td>
                </tr>
        @endforeach
            </tbody>
        </table>
    </div>
{{$preparationReceipts->links()}}
</div>
@endsection
