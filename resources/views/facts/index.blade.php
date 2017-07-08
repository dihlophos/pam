@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')


  <div class="panel panel-default">
      <div class="panel-heading clearfix">
          <h1 class="panel-title pull-left" style="padding-top: 7.5px;">Факт по объекту: {{ $object->name }}</h1>
          <a href="/object/{{ $object->id }}/fact/create" class="btn btn-default pull-right ">Добавить</a>
      </div>
      <div class="panel-body">
      @if (count($facts) > 0)
        {{$facts->links()}}
        <table class="table table-striped task-table">

            <thead>
                <th>Дата</th>
                <th>Код записи сведений о животном</th>
                <th>Услуга</th>
                <th>Удалить</th>
            </thead>

          <tbody>
            @foreach ($facts as $fact)
              <tr>
                <td class="table-text">
                    {{ $fact->date }}
                </td>
                <td class="table-text">
                    {{ $fact->animal->id }}
                </td>
                <td class="table-text">
                    {{ $fact->service->name }}
                </td>
                <td>
                    <form action="/object/{{ $fact->object_id }}/fact/{{ $fact->id }}" method="POST">
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
        {{$facts->links()}}
        @endif
      </div>
    </div>
@endsection
