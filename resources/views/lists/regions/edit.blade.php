@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="/regions/{{ $region->id }}" class="well" id="RegionEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>Редактирование региона</legend>
		<div class="form-group required">
            <label for="RegionName">Название</label>
            <input name="name" class="form-control" maxlength="50" type="text" id="RegionName" required="required">
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </fieldset>
</form>

<form action="/lists/district" class="form-inline text-right" id="DistrictAddForm" method="POST" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="form-group required">
        <input name="name" id="district-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:800px">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </div>
</form>
<br/>
@if (count($districts) > 0)
<div class="panel panel-default">
  <div class="panel-heading">
    Единицы учета
  </div>

  <div class="panel-body">
    {{$districts->links()}}
    <table class="table table-striped task-table">

      <thead>
        <th>Название</th>
        <th>Удалить</th>
      </thead>

      <tbody>
        @foreach ($districts as $district)
          <tr>
            <td class="table-text">
                <form class="form-inline" action="/lists/district/{{ $district->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group required">
                        <input name="name" class="form-control" value="{{ $district->name }}" maxlength="255" type="text" style="width:800px">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить
                        </button>
                    </div>
                </form>
            </td>
            <td>
                <form action="/lists/district/{{ $district->id }}" method="POST">
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
    {{$districts->links()}}
  </div>
</div>
@endif
@endsection
