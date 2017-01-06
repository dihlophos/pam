@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- Отображение ошибок проверки ввода -->
@include('common.errors')
@include('common.flash')

<form action="/lists/disease/{{ $disease->id }}" method="POST" class="well" id="DiseaseEditForm" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
    	<legend>Редактирование записи</legend>
    	<div class="form-group required">
            <label for="disease_name">Название</label>
            <input name="name" id="disease_name" class="form-control"
                    maxlength="255" type="text" required="required"
                    value="{{ $disease->name }}" >
        </div>
        <div class="form-group">
            <label for="disease-disease_type_id">Вид болезни</label>
            <select name="disease_type_id" class="form-control" id="disease-disease_type_id">
                @foreach ($disease_types as $id => $disease_type)
                    <option value="{{$id}}" {{$disease->disease_type_id == $id ? 'selected' : ''}}>{{$disease_type}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="disease-animal_type_id">Виды животных</label>
            <select name="animal_types[]" id="disease-animal_type_id" class="form-control" multiple>
                @foreach ($animal_types as $id => $animal_type)
                    <option value="{{$id}}" {{$disease->animalTypes->pluck('id')->contains($id) ? 'selected' : ''}}>{{$animal_type}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </fieldset>
</form>

<div class="well">
    <form action="/lists/disease/{{ $disease->id }}/add_service" id="DiseasesServiceAddForm" class="form-inline text-left"
          method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <fieldset>
    		<legend>Услуги</legend>
    	    <div class="row">
    			<div class="col-md-12">
                    <div class="form-group required">
                        <label for="DiseasesServiceServiceId">Услуга</label>
                        <select name="service_id" class="form-control" style="width:300px;margin:0 10px" id="DiseasesServiceServiceId" required="required">
                            @foreach ($services as $id => $service)
                                <option value="{{$id}}">{{$service}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="DiseasesServiceYearMultiplicity">Кратность</label>
                        <input name="year_multiplicity" class="form-control" style="width:100px;margin:0 10px" type="number" id="DiseasesServiceYearMultiplicity">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-default" type="submit" value="Добавить услугу">
                    </div>
                </div>
    		</div>
    	</fieldset>
    </form>
	<br>
	<table class="table">
		<tbody>
            <tr><th>Услуга</th><th>Кратность</th><th>Удалить</th></tr>
            @foreach ($disease->services as $service)
			<tr>
	            <td>{{$service->name}}</td>
                <td>{{$service->pivot->year_multiplicity}}</td>
			    <td>
                    <form action="/lists/disease/{{ $disease->id }}/destroy_service/{{$service->id}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button class="btn btn-primary">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>
	        </tr>
            @endforeach
		</tbody>
    </table>
</div>


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
