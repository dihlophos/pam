@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="/lists/municipality/{{ $municipality->id }}" class="well" id="MunicipalityEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>Редактирование муниципальнного образования</legend>
        <input name="district_id" type="hidden" id="MunicipalityRegionId" required="required" value="{{ $municipality->district_id }}">
		<div class="form-group required">
            <label for="MunicipalityName">Название</label>
            <input name="name" class="form-control" maxlength="50" type="text" id="MunicipalityName" required="required" value="{{ $municipality->name }}">
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </fieldset>
</form>

<form action="/lists/city" class="form-inline text-right" id="CityAddForm" method="POST" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="form-group required">
        <input name="municipality_id" type="hidden" id="municipality-municipality_id" value="{{$municipality->id}}">
        <input name="name" id="city-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:800px">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </div>
</form>
<br/>
@if (count($cities) > 0)
<div class="panel panel-default">
  <div class="panel-heading">
      Населенные пункты
  </div>

  <div class="panel-body">
    {{$cities->links()}}
    <table class="table table-striped task-table">

      <thead>
        <th>Название</th>
        <th>Удалить</th>
      </thead>

      <tbody>
        @foreach ($cities as $city)
          <tr>
            <td class="table-text">
                <form class="form-inline" action="/lists/city/{{ $city->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input name="municipality_id" type="hidden" value="{{ $city->municipality_id }}">
                    <div class="form-group required">
                        <input name="name" class="form-control" value="{{ $city->name }}" maxlength="255" type="text" style="width:800px">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить
                        </button>
                    </div>
                </form>
            </td>
            <td>
                <form action="/lists/city/{{ $city->id }}" method="POST">
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
    {{$cities->links()}}
  </div>
</div>
@endif
@endsection
