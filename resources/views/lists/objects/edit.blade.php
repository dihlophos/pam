@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="/lists/object/{{ $object->id }}" class="well" id="ObjectEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>
            Редактирование
            @if ($object->type == 'organ')
                органа
            @elseif ($object->type == 'institution')
                учреждения
            @elseif ($object->type == 'subdivision')
                подразделения
            @elseif ($object->type == 'object')
                объекта
            @else
                {{$object->type}}
            @endif
        </legend>
        @foreach($ancestors as $i => $ancestor)
            <a href="{{route('object.edit', $ancestor->id)}}">{{$ancestor->name}}</a> >
        @endforeach
        @if ($ancestors->count())
            {{$object->name}}
        @endif
		<div class="form-group required">
            <label for="ObjectName">Название</label>
            <input name="name" class="form-control" maxlength="50" type="text" id="ObjectName" required="required" value="{{ $object->name }}">
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </fieldset>
</form>

@if ($object->type != 'object')
<form action="/lists/object" class="form-inline text-right" id="ObjectAddForm" method="POST" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="form-group required">
        <input name="parent_id" type="hidden" id="object-parent_id" value="{{$object->id}}">
        @if ($object->type == 'organ')
            <input name="type" type="hidden" id="object-type" value="institution">
        @elseif ($object->type == 'institution')
            <input name="type" type="hidden" id="object-type" value="subdivision">
        @elseif ($object->type == 'subdivision')
            <input name="type" type="hidden" id="object-type" value="object">
        @endif
        <input name="name" id="object-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:800px">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </div>
</form>
<br/>
@endif
@if (count($objects) > 0)
<div class="panel panel-default">
  <div class="panel-heading">
      @if ($object->type == 'organ')
          Учреждения
      @elseif ($object->type == 'institution')
          Подразделения
      @elseif ($object->type == 'subdivision')
          Объекты
      @else
          {{$object->type}}
      @endif
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
