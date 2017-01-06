@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/disease" class="form-inline" id="DiseaseAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="disease-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:600px">
        </div>
        <div class="form-group required">
            <select name="disease_type_id" id="disease-disease_type_id" class="form-control"  style="min-width:200px">
                @foreach ($disease_types as $id => $disease_type)
                    <option value="{{$id}}">{{$disease_type}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group required">
            <select name="animal_types[]" id="disease-animal_type_id" class="form-control" multiple>
                @foreach ($animal_types as $id => $animal_type)
                    <option value="{{$id}}">{{$animal_type}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </form>
    <br/>
  @if (count($diseases) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Болезни
      </div>

      <div class="panel-body">
        {{$diseases->links()}}
        <table class="table table-striped task-table">
            <thead>
                <th>Название</th>
                <th>Вид болезни</th>
                <th>Виды животных</th>
                <th style="width:250px">Услуги : кратность</th>
                <th>Удалить</th>
            </thead>
          <tbody>
            @foreach ($diseases as $disease)
              <tr>
                <td class="table-text">
                    <a href="/lists/disease/{{ $disease->id }}/edit">{{ $disease->name }}</a>
                </td>
                <td class="table-text">
                    {{$disease->diseaseType->name}}
                </td>
                <td class="table-text">
                    @foreach ($disease->animalTypes as $animalType)
                        {{$animalType->name}}{{$animalType!=$disease->animalTypes->last()?',':''}}
                    @endforeach
                </td>
                <td class="table-text">
                    @foreach ($disease->services as $service)
                        {{$service->name}}: {{$service->pivot->year_multiplicity}}<br/>
                    @endforeach
                </td>
                <td>
                    <form action="/lists/disease/{{ $disease->id }}" method="POST">
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
        {{$diseases->links()}}
      </div>
    </div>
   @endif
@endsection

@section('scripts')
<script src="{{ URL::asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
	$('select[name="animal_types[]"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'вид животного'
	});
});
</script>
@endsection
