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
            <label for="AnimalCount">Количество</label>
            <input name="count" class="form-control" type="number" id="AnimalCount" value="{{ old('count') }}" min="0" max="99999">
        </div>
    <fieldset>
		<legend>Индивидуальные данные</legend>
        <div class="form-group">
            <label for="AnimalRegnum">Регистрационный номер</label>
            <input name="regnum" class="form-control" maxlength="45" type="text" value="{{ old('regnum') }}" id="AnimalRegnum">
        </div>
        <div class="form-group">
            <label for="AnimalName">Кличка</label>
            <input name="name" class="form-control" maxlength="45" type="text" value="{{ old('name') }}" id="AnimalName">
        </div>
        <div class="form-group">
            <label for="AnimalBirthday">Дата рождения</label>
            <input name="birthday" type="date" class="form-control" id="AnimalBirthday" value="{{ old('birthday') }}">
        </div>
        <div class="form-group">
            <label for="AnimalMarks">Пол, порода, окрас, особые приметы</label>
            <input name="marks" class="form-control" maxlength="255" type="text" value="{{ old('marks') }}" id="AnimalMarks">
        </div>
        <div class="form-group">
            <label for="AnimalChipnum">№ чипа татуировки</label>
            <input name="chipnum" class="form-control" maxlength="45" type="text" value="{{ old('chipnum') }}" id="AnimalChipnum">
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

	$('#AnimalAnimalTypeId').selectize({
        create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'Укажите вид животного'
	});

});

</script>
@endsection
