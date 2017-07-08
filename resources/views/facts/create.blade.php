@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
<style>
    .preventions_only, .diagnostic_tests_only, .sanitary_works_only
    {
        display:none;
    }
</style>
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="/object/{{$object->id}}/fact" class="well" id="FactCreateForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <input name="object_id" type="hidden" id="FactObjectId" value="{{ $object->id }}">
    <fieldset>
		<legend>Сведения о документе</legend>
		<div class="form-group required">
            <label for="FactDate">Дата</label>
            <input name="date" type="date" class="form-control" required="required" id="FactDate" value="{{ old('date')?old('date'):date('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="FactBasicDocumentId">Название</label>
            <select name="basic_document_id" id="FactBasicDocumentId" class="form-control">
                @foreach ($basic_documents as $id => $basic_document)
                    <option value="{{$id}}" {{ old('basic_document_id') == $id ? 'selected' : '' }}>{{ $basic_document }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="FactAnimalId">Код записи сведений о животном</label>
            <select name="animal_id" id="FactAnimalId" class="form-control">
                @foreach ($animals as $animal)
                    <option value="{{$animal->id}}" {{ old('animal_id') == $animal->id ? 'selected' : '' }}>
                        {{ $animal->animalType->name }}{{$animal->name?' | '.$animal->name:''}} - (возраст: {{$animal->age}})
                    </option>
                @endforeach
            </select>
        </div>
    </fieldset>
    <fieldset>
		<legend>Сведения об услуге</legend>
        <label for="FactServiceId">Услуга</label>
        <select name="service_id" id="FactServiceId" class="form-control">
            <option value="">Укажите услугу</option>
            @foreach ($services as $service)
                <option value="{{$service->id}}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                    {{ $service->name }}
                </option>
            @endforeach
        </select>
        <div class="form-group preventions_only">
            <label for="PreventionServiceType">Вид услуги</label>
            <select name="service_type" id="PreventionServiceType" class="form-control">
                    <option value="профилактическая" {{ old('service_type') == 'профилактическая' ? 'selected' : '' }}>
                        профилактическая
                    </option>
                    <option value="вынужденная" {{ old('service_type') == 'вынужденная' ? 'selected' : '' }}>
                        вынужденная
                    </option>
            </select>
        </div>
        <div class="preventions_only" style="color:red">
            профилактика: покачто форма не доделана
        </div>

        <div class="diagnostic_tests_only" style="color:red">
            исследования: покачто нет формы
        </div>

        <div class="sanitary_works_only" style="color:red">
            вет.сан. работы: покачто нет формы
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
    var services = {!!(string)$services!!};

	$('#FactServiceId').selectize({
        create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'Укажите услугу',
        onChange: function(event) {
            $('.preventions_only, .diagnostic_tests_only, .sanitary_works_only').hide();
            var selected_service = $.grep(services, function(e) { return e['id'] == event; })[0];
            var tab_index = selected_service?selected_service['tab_index']:0;
            switch (tab_index)
            {
                case 1:
                    $('.preventions_only').show();
                    break;
                case 2:
                    $('.diagnostic_tests_only').show();
                    break;
                case 3:
                    $('.sanitary_works_only').show();
                    break;
            }
        }
	});

});

</script>
@endsection
