@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- Отображение ошибок проверки ввода -->
@include('common.errors')
@include('common.flash')
<form action="/lists/service/{{ $service->id }}" method="POST" class="well" id="ServiceTypeEditForm" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
    	<legend>Редактирование записи</legend>
    	<div class="form-group required">
            <label for="service_name">Название</label>
            <input name="name" id="service_name" class="form-control"
                    maxlength="255" type="text" required="required"
                    value="{{ $service->name }}" >
        </div>
        <div class="form-group required">
            <label for="service-service_category_id">Категория</label>
            <select name="service_category_id" id="service-service_category_id" class="form-control" style="min-width:200px">
                @foreach ($service_categories as $id => $category)
                    <option value="{{$id}}" {{$service->service_category_id == $id ? 'selected' : ''}}>{{$category}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="service-service_types">Виды услуги</label>
            <select name="service_types[]" id="service-service_types" class="form-control"  style="min-width:200px" multiple>
                @foreach ($service_types as $id => $service_type)
                    <option value="{{$id}}" {{$service->service_types->pluck('id')->contains($id) ? 'selected' : ''}}>{{$service_type}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group required">
            <label for="service-measure_id">Единица измерения</label>
            <select name="measure_id" id="service-measure_id" class="form-control" style="min-width:197px">
                @foreach ($measures as $id => $measure)
                    <option value="{{$id}}" {{$service->measure_id == $id ? 'selected' : ''}}>{{$measure}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group required">
            <label for="service-tab_index">Раздел (закладка)</label>
            <select name="tab_index" id="service-tab_index" class="form-control" style="min-width:141px">
                @foreach ($tabs as $idx => $tab_name)
                    <option value="{{$idx}}"  {{$service->tab_index == $idx ? 'selected' : ''}}>{{$tab_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </fieldset>
</form>

@endsection

@section('scripts')
<script src="{{ URL::asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    $('#service-service_types').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'виды услуг'
	});
	
	$('select').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
	});
});
</script>
@endsection
