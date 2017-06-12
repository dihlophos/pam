@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="/lists/organ/{{ $organ->id }}" class="well" id="OrganEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>Редактирование органа</legend>
		<div class="form-group required">
            <label for="OrganName">Название</label>
            <input name="name" class="form-control" maxlength="50" type="text" id="OrganName" required="required" value="{{ $organ->name }}">
        </div>
        <div class="form-group">
            <label for="organ-region_id">Регион</label>
            <select name="region_id" id="organ-region_id" class="form-control">
                @foreach ($regions as $id => $region)
                    <option value="{{$id}}" {{$organ->region_id == $id ? 'selected' : ''}}>{{$region}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </fieldset>
</form>

<form action="/lists/institution" class="form-inline text-right" id="InstitutionAddForm" method="POST" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="form-group required">
        <input name="organ_id" type="hidden" id="institution-organ_id" value="{{$organ->id}}">
        <input name="name" id="institution-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:800px">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </div>
</form>
<br/>
@if (count($institutions) > 0)
<div class="panel panel-default">
  <div class="panel-heading">
    Учреждения
  </div>

  <div class="panel-body">
    {{$institutions->links()}}
    <table class="table table-striped task-table">

      <thead>
        <th>Название</th>
        <th>Удалить</th>
      </thead>

      <tbody>
        @foreach ($institutions as $institution)
          <tr>
            <td class="table-text">
                <a href="/lists/institution/{{ $institution->id }}/edit">{{ $institution->name }}</a>
            </td>
            <td>
                <form action="/lists/institution/{{ $institution->id }}" method="POST">
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
    {{$institutions->links()}}
  </div>
</div>
@endif
@endsection

@section('scripts')
<script src="{{ URL::asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
	$('select[name="region_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'регион'
	});
});
</script>
@endsection
