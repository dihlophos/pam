@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="/object/{{ $object->id }}" class="well" id="ObjectEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>Общие данные</legend>
        <input name="subdivision_id" type="hidden" id="ObjectObjectId" required="required" value="{{ $object->subdivision_id }}">
		<div class="form-group required">
            <label for="ObjectName">Название объекта / ФИО владельца</label>
            <input name="name" class="form-control" maxlength="255" type="text" id="ObjectName" required="required" value="{{ $object->name }}">
        </div>
        <div class="form-group">
            <label for="ObjectAddress">Адрес</label>
            <input name="address" class="form-control" maxlength="250" type="text" id="ObjectAddress" required="required" value="{{ $object->address }}">
        </div>
        <div class="form-group">
            <label for="ObjectPhone">Телефон</label>
            <input name="phone" class="form-control" maxlength="50" type="text" id="ObjectPhone" required="required" value="{{ $object->phone }}">
        </div>
    </fieldset>
    <fieldset>
		<legend>Местонахождение объекта</legend>
        <div class="alert alert-info" role="alert">Регион и район заполнятся автоматически.</div>
        <div class="form-group">
            <label for="ObjectMunicipalityId">Муниципальное образование</label>
            <select name="municipality_id" id="ObjectMunicipalityId" class="form-control">
                @foreach ($municipalities as $id => $municipality)
                    <option value="{{$id}}" {{ $object->municipality_id == $id ? 'selected' : '' }}>{{ $municipality }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ObjectCityId">Населенный пункт</label>
            <select name="city_id" id="ObjectCityId" class="form-control">
                @foreach ($cities as $id => $city)
                    <option value="{{$id}}" {{ $object->city_id == $id ? 'selected' : '' }}>{{ $city }}</option>
                @endforeach
            </select>
        </div>
    </fieldset>
    <fieldset>
		<legend>Характеристики объекта</legend>
        <div class="form-group">
            <label for="ObjectLandArea">Площадь территории (кв. м.)</label>
            <input name="land_area" class="form-control" step="0.1" type="number" id="ObjectLandArea" value="{{ $object->land_area }}">
        </div>
        <div class="form-group">
            <label for="ObjectProcessingArea">Площадь обработки помещений (кв. м.)</label>
            <input name="processing_area" class="form-control" step="0.1" type="number" id="ObjectProcessingArea" value="{{ $object->processing_area }}">
        </div>
    </fieldset>
    <div class="form-group">
        <input class="btn btn-default" type="submit" value="Сохранить">
    </div>
</form>
@endsection

@section('scripts')
<script src="{{ URL::asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {

	var xhr;
	var select_municipality, $select_municipality;
	var select_city, $select_city;

	$select_municipality = $('#ObjectMunicipalityId').selectize({
		plugins: ['restore_on_backspace'],
		create: false,
		selectOnTab: true,
		onInitialize: function() {this.selected_value = this.getValue();},
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				this.setValue(this.selected_value );
			}
		},
		onChange: function(value) {
			value=(!value || value==0)?this.selected_value:value;this.selected_value=value;
			if (!value.length) return;
			select_city.disable();
			select_city.clearOptions();
			select_city.load(function(callback) {
				xhr && xhr.abort();
				xhr = $.ajax({
					type: 'get',
					url: '/api/municipalities/'+select_municipality.selected_value+'/cities',
					success: function(results) {
						select_city.enable();
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});

	$select_city = $('#ObjectCityId').selectize({
		valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
		plugins: ['restore_on_backspace'],
		create: false,
		selectOnTab: true,
		onInitialize: function() {this.selected_value = this.getValue();},
		onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				this.setValue(this.selected_value );
			}
		}
	});

	select_city  = $select_city[0].selectize;
	select_municipality = $select_municipality[0].selectize;
	@if(null==($object->city_id))
	select_city.disable();
	@endif
});

</script>
@endsection
