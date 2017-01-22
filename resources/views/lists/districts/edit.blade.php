@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="/lists/district/{{ $district->id }}" class="well" id="DistrictEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>Редактирование района</legend>
        <input name="region_id" type="hidden" id="DistrictRegionId" required="required" value="{{ $district->region_id }}">
		<div class="form-group required">
            <label for="DistrictName">Название</label>
            <input name="name" class="form-control" maxlength="50" type="text" id="DistrictName" required="required" value="{{ $district->name }}">
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </fieldset>
</form>

<form action="/lists/municipality" class="form-inline text-right" id="MunicipalityAddForm" method="POST" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="form-group required">
        <input name="district_id" type="hidden" id="district-district_id" value="{{$district->id}}">
        <input name="name" id="municipality-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:800px">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </div>
</form>
<br/>
@if (count($municipalities) > 0)
<div class="panel panel-default">
  <div class="panel-heading">
      Муниципальные образования
  </div>

  <div class="panel-body">
    {{$municipalities->links()}}
    <table class="table table-striped task-table">

      <thead>
        <th>Название</th>
        <th>Удалить</th>
      </thead>

      <tbody>
        @foreach ($municipalities as $municipality)
          <tr>
            <td class="table-text">
                <a href="/lists/municipality/{{ $municipality->id }}/edit">{{ $municipality->name }}</a>
            </td>
            <td>
                <form action="/lists/municipality/{{ $municipality->id }}" method="POST">
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
    {{$municipalities->links()}}
  </div>
</div>
@endif
@endsection
