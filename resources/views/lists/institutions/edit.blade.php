@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="/lists/institution/{{ $institution->id }}" class="well" id="InstitutionEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>Редактирование учреждения</legend>
        <input name="organ_id" type="hidden" id="InstitutionOrganId" required="required" value="{{ $institution->organ_id }}">
		<div class="form-group required">
            <label for="InstitutionName">Название</label>
            <input name="name" class="form-control" maxlength="50" type="text" id="InstitutionName" required="required" value="{{ $institution->name }}">
        </div>
        <div class="form-group">
            <label for="institution-district_id">Районы</label>
            <select name="districts[]" id="institution-district_id" class="form-control" multiple>
                @foreach ($districts as $id => $district)
                    <option value="{{$id}}" {{$institution->districts->pluck('id')->contains($id) ? 'selected' : ''}}>{{$district}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </fieldset>
</form>

<form action="/lists/subdivision" class="form-inline text-right" id="SubdivisionAddForm" method="POST" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="form-group required">
        <input name="institution_id" type="hidden" id="institution-institution_id" value="{{$institution->id}}">
        <input name="name" id="subdivision-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:800px">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </div>
</form>
<br/>
@if (count($subdivisions) > 0)
<div class="panel panel-default">
  <div class="panel-heading">
      Подразделения
  </div>

  <div class="panel-body">
    {{$subdivisions->links()}}
    <table class="table table-striped task-table">

      <thead>
        <th>Название</th>
        <th>Удалить</th>
      </thead>

      <tbody>
        @foreach ($subdivisions as $subdivision)
          <tr>
            <td class="table-text">
                <a href="/lists/subdivision/{{ $subdivision->id }}/edit">{{ $subdivision->name }}</a>
            </td>
            <td>
                <form action="/lists/subdivision/{{ $subdivision->id }}" method="POST">
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
    {{$subdivisions->links()}}
  </div>
</div>
@endif
@endsection

@section('scripts')
<script src="{{ URL::asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
	$('select[name="districts[]"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'районы'
	});
});
</script>
@endsection
