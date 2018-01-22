@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="/object/{{$object->id}}/animal" class="well" id="AnimalCreateForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <input name="object_id" type="hidden" id="AnimalObjectId" value="{{ $object->id }}">
    <input name="individual" type="hidden" id="AnimalIndividual" value="0">
    <fieldset>
		<legend>Общие данные</legend>
		<div class="form-group">
            <label for="AnimalAnimalTypeId">Вид животного</label>
            <select name="animal_type_id" class="form-control" id="AnimalAnimalTypeId">
                <option value="">Укажите вид животного</option>
                @foreach ($animalTypes as $id => $animalType)
                    <option value="{{$id}}"{{ old('animal_type_id') == $id ? 'selected' : '' }}>{{ $animalType }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="AnimalAge">Возраст на 1 января т.г.</label>
            <input name="age" class="form-control" type="number" id="AnimalAge" value="{{ old('age') }}" min="0" max="999">
        </div>
        <div class="form-group">
            <label for="AnimalAgesexId">Половозрастная группа</label>
            <select name="agesex_id" class="form-control" id="AnimalAgesexId">
            </select>
        </div>
        <div class="form-group">
            <label for="AnimalCount">Количество</label>
            <input name="count" class="form-control" type="number" id="AnimalCount" value="{{ old('count') }}" min="0" max="99999">
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

    var xhr_agesex;
	var select_agesex, $select_agesex;

	$('#AnimalAnimalTypeId').selectize({
        create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'Укажите вид животного',
        onChange: function(value) {
            LoadAgesex(this.getValue(), function(value) {
                var defaultValue = {id:'', name:'Автоматически по возрасту'};
                select_agesex.addOption(defaultValue);
                select_agesex.setValue(defaultValue.id);
            });
		}
	});

	$select_agesex = $('#AnimalAgesexId').selectize({
	    valueField: 'id',
		labelField: 'name',
        create: false,
		selectOnTab: true,
        placeholder: 'Укажите половозрастную группу'
	});

	function LoadAgesex(animal_type_id, success) {
	    select_agesex.disable();
        select_agesex.clearOptions();
        select_agesex.load(function(callback) {
            xhr_agesex && xhr_agesex.abort();
            xhr_agesex = $.ajax({
                type: 'get',
                url: '/api/animal_types/' + animal_type_id + '/agesexes',
                success: function(results) {
                    callback(results);
                },
                error: function() {
                    callback();
                }
            });
            xhr_agesex.then(function(results) {
                select_agesex.enable();
                success(results);
            });
        });
	}

	select_agesex = $select_agesex[0].selectize;

	select_agesex.disable();

});

</script>
@endsection
