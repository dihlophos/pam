@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- Отображение ошибок проверки ввода -->
@include('common.errors')
@include('common.flash')
<form action="/lists/preparation/{{ $preparation->id }}" method="POST" class="well" id="PreparationEditForm" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
    	<legend>Редактирование записи</legend>
    	<div class="form-group required">
            <label for="preparation_name">Название</label>
            <input name="name" id="preparation_name" class="form-control"
                    maxlength="255" type="text" required="required"
                    value="{{ $preparation->name }}" >
        </div>
        <div class="form-group">
            <label for="preparation-diseases">Болезни</label>
            <select name="diseases[]" id="preparation-diseases" class="form-control"  style="min-width:200px" multiple>
                @foreach ($diseases as $id => $disease)
                    <option value="{{$id}}" {{$preparation->diseases->pluck('id')->contains($id) ? 'selected' : ''}}>{{$disease}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="preparation-services">Услуги</label>
            <select name="services[]" id="preparation-services" class="form-control" multiple>
                @foreach ($services as $id => $service)
                    <option value="{{$id}}" {{$preparation->services->pluck('id')->contains($id) ? 'selected' : ''}}>{{$service}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="preparation-applicationMethods">Применения</label>
            <select name="applicationMethods[]" id="preparation-applicationMethods" class="form-control" multiple>
                @foreach ($applicationMethods as $id => $applicationMethod)
                    <option value="{{$id}}" {{$preparation->applicationMethods->pluck('id')->contains($id) ? 'selected' : ''}}>{{$applicationMethod}}</option>
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
    $('select[name="diseases[]"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'болезни'
	});
    $('select[name="services[]"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'услуги'
	});
    $('select[name="applicationMethods[]"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'применение'
	});
});
</script>
@endsection
