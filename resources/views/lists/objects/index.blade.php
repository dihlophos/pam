@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/object" class="form-inline text-right" id="ObjectAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <input name="type" type="hidden" value="organ">
        <div class="form-group required">
            <input name="name" id="object-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:800px">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i> Добавить
            </button>
        </div>
    </form>
    <br/>
  @if (count($objects) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Органы
      </div>

      <div class="panel-body">
        {{$objects->links()}}
        <table class="table table-striped task-table">

          <thead>
            <th>Название</th>
            <th>Удалить</th>
          </thead>

          <tbody>
            @foreach ($objects as $object)
              <tr>
                <td class="table-text">
                    <a href="/lists/object/{{ $object->id }}/edit">{{ $object->name }}</a>
                </td>
                <td>
                    <form action="/lists/object/{{ $object->id }}" method="POST">
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
        {{$objects->links()}}
      </div>
    </div>
   @endif
@endsection
