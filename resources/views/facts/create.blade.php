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

<form action="{{route('object.fact.store', [$object->id])}}" class="well" id="FactCreateForm" method="post" accept-charset="utf-8">
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
        <div class="form-group preventions_only diagnostic_tests_only">
            <label for="FactAnimalId">Код записи сведений о животном</label>
            <select name="animal_id" id="FactAnimalId" class="form-control">
                    <option value="">Укажите животное</option>
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
        <div class="form-group">
            <label for="ServiceTypeId">Вид услуги</label>
            <select name="service_type_id" id="ServiceTypeId" class="form-control">
            </select>
        </div>
        <div class="form-group diagnostic_tests_only">
            <label for="DiagnosticTestResearchType">Вид исследований</label>
            <select name="research_type_id" id="DiagnosticTestResearchType" class="form-control">
                <option value="">Укажите вид исследований</option>
            @foreach ($research_types as $id => $research_type)
                <option value="{{$id}}" {{ old('research_type_id') == $id ? 'selected' : '' }}>
                    {{ $research_type }}
                </option>
            @endforeach
            </select>
        </div>
        <div class="form-group diagnostic_tests_only">
            <label for="DiagnosticTestDiseases">Болезни</label>
            <select name="diseases[]" class="form-control" multiple="multiple" id="DiagnosticTestDiseases">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group diagnostic_tests_only">
            <label for="DiagnosticTestYearMultiplicity">Кратность услуги в текущем году</label>
            <select name="year_multiplicity" class="form-control" id="DiagnosticTestYearMultiplicity">
                <option value="первый раз">первый раз</option>
                <option value="второй раз">второй раз</option>
            </select>
        </div>
        <div class="form-group diagnostic_tests_only">
            <label for="DiagnosticTestServiceCharacteristics">Характеристика услуги</label>
            <select name="service_characteristics" class="form-control" id="DiagnosticTestServiceCharacteristics">
                <option value="первично">первично</option>
                <option value="вторично">вторично</option>
            </select>
        </div>
    </fieldset>
    <fieldset>
        <legend>Количество</legend>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkObjectsCount">Количество объектов</label>
            <input name="objects_count" class="form-control" type="number" id="SanitaryWorkObjectsCount" value="{{ old('objects_count')?old('objects_count'):0 }}">
        </div>
        <div class="form-group preventions_only diagnostic_tests_only sanitary_works_only">
            <label for="Count">Всего</label>
            <input name="count" class="form-control" type="number" id="Count" value="{{ old('count')?old('count'):0 }}">
        </div>
        <div class="form-group preventions_only diagnostic_tests_only sanitary_works_only">
            <label for="CountGz">По ГЗ</label>
            <input name="count_gz" class="form-control" type="number" id="CountGz" value="{{ old('count_gz')?old('count_gz'):0 }}">
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkIndoorCount">Помещений всего (кв.м)</label>
            <input name="indoor_count" class="form-control" type="number" id="SanitaryWorkIndoorCount" value="{{ old('indoor_count')?old('indoor_count'):0 }}">
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkIndoorCountGz">Помещений по ГЗ (кв.м)</label>
            <input name="indoor_count_gz" class="form-control" type="number" id="SanitaryWorkIndoorCountGz" value="{{ old('indoor_count_gz')?old('indoor_count_gz'):0 }}">
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkOutdoorCount">Территории всего (кв.м)</label>
            <input name="outdoor_count" class="form-control" type="number" id="SanitaryWorkOutdoorCount" value="{{ old('outdoor_count')?old('outdoor_count'):0 }}">
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkOutdoorCountGz">Территории по ГЗ (кв.м)</label>
            <input name="outdoor_count_gz" class="form-control" type="number" id="SanitaryWorkOutdoorCountGz" value="{{ old('outdoor_count_gz')?old('outdoor_count_gz'):0 }}">
        </div>
        <div class="form-group preventions_only">
            <label for="PreventionCountFinal">Окончательных обработок</label>
            <input name="count_final" class="form-control" type="number" id="PreventionCountFinal" value="{{ old('count_final')?old('count_final'):0 }}">
        </div>
        <div class="form-group preventions_only">
            <label for="PreventionCountIll">Заболело (осложнения)</label>
            <input name="count_ill" class="form-control" type="number" id="PreventionCountIll" value="{{ old('count_ill')?old('count_ill'):0 }}">
        </div>
        <div class="form-group preventions_only">
            <label for="PreventionCountRip">Пало, вынуж./убит</label>
            <input name="count_rip" class="form-control" type="number" id="PreventionCountRip" value="{{ old('count_rip')?old('count_rip'):0 }}">
        </div>
        <div class="form-group diagnostic_tests_only">
            <label for="DiagnosticTestCountPositive">Положительно</label>
            <input name="count_positive" class="form-control" type="number" id="DiagnosticTestCountPositive" value="{{ old('count_positive')?old('count_positive'):0 }}">
        </div>
        <div class="form-group">
            <label for="PreventionExecutorId">Исполнитель</label>
            <select name="executor_id" class="form-control" id="PreventionExecutorId">
                @foreach ($executors as $id => $executor)
                <option value="{{$id}}" {{ old('executor_id') == $id ? 'selected' : '' }}>{{ $executor }}</option>
                @endforeach
            </select>
        </div>
    </fieldset>
    <fieldset class="preventions_only diagnostic_tests_only sanitary_works_only">
        <legend>Сведения об использованиии препаратов</legend>
        <div class="form-group diagnostic_tests_only">
            <label for="DiagnosticTestConclusionNum">Дата, номер заключения</label>
            <input name="conclusion_num" class="form-control" maxlength="255" type="text"
                   value="{{ old('conclusion_num') ? old('conclusion_num') : '' }}" id="DiagnosticTestConclusionNum">
        </div>
        <div class="form-group">
            <label for="PreparationReceiptId">Код записи препарата</label>
            <select name="preparation_receipt_id" id="PreparationReceiptId" class="form-control">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group preventions_only sanitary_works_only">
            <label for="ApplicationMethodId">Порядок применения</label>
            <select name="application_method_id" class="form-control" id="ApplicationMethodId">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group preventions_only">
            <label for="PreventionDiseases">Болезни</label>
            <select name="diseases[]" class="form-control" multiple="multiple" id="PreventionDiseases">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkTemperature">Температкра</label>
            <input name="temperature" class="form-control" type="number"
                   value="{{ old('temperature')?old('temperature'):0 }}" id="SanitaryWorkTemperature">
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkConcentration">Концентрация</label>
            <input name="concentration" class="form-control" type="number"
                   value="{{ old('concentration')?old('concentration'):0 }}" id="SanitaryWorkConcentration">
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkConsumption">Расход на кв. м</label>
            <input name="сonsumption" class="form-control" type="number"
                   value="{{ old('сonsumption')?old('сonsumption'):0 }}" id="SanitaryWorkConsumption">
        </div>
        <div class="form-group preventions_only diagnostic_tests_only sanitary_works_only">
            <label for="PreparationUsedDoses">Израсходовано доз (мл)</label>
            <input name="preparation_used_doses" class="form-control" type="number"
                   value="{{ old('preparation_used_doses')?old('preparation_used_doses'):0 }}"
                   id="PreparationUsedDoses">
        </div>
        <div class="form-group preventions_only diagnostic_tests_only sanitary_works_only">
            <label for="Comment">Примечание</label>
            <input name="comment" class="form-control" maxlength="255" type="text"
                   value="{{ old('comment')?old('comment'):'' }}" id="Comment">
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
    var animals = {!!(string)$animals!!};

    var tab_index;

    var xhr_method, xhr_diseases, xhr_receipts, xhr_service_type;
	var select_receipts, $select_receipts;
    var select_method, $select_method;
	var select_diseases, $select_prev_diseases, $select_test_diseases;
	var select_service, $select_service
	var select_service_type, $select_service_type

    $select_service_type = $('#ServiceTypeId').selectize({
        valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
        create: false,
		//persist: false,
		selectOnTab: true,
        plugins: ['restore_on_backspace'],
        placeholder: 'Укажите вид услуги'
    });

    select_service_type = $select_service_type[0].selectize;

    $select_prev_diseases = $('#PreventionDiseases').selectize({
        valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
        create: false,
		//persist: false,
		selectOnTab: true,
        plugins: ['restore_on_backspace'],
        placeholder: 'Укажите болезни'
    });

    $select_test_diseases = $('#DiagnosticTestDiseases').selectize({
        valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
        create: false,
		//persist: false,
		selectOnTab: true,
        plugins: ['restore_on_backspace'],
        placeholder: 'Укажите болезни'
    });

    $select_method = $('#ApplicationMethodId').selectize({
        valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
        create: false,
		//persist: false,
		selectOnTab: true,
        plugins: ['restore_on_backspace'],
        placeholder: 'Укажите порядок применения'
    });

    select_method = $select_method[0].selectize;

    $select_receipts = $('#PreparationReceiptId').selectize({
        valueField: 'id',
		labelField: 'name',
		searchField: ['id', 'name', 'series'],
        create: false,
		//persist: false,
		selectOnTab: true,
        plugins: ['restore_on_backspace'],
        placeholder: 'Укажите препарат',
        render: {
            item: function(item, escape) {
                return '<div>' +
                    '<span>' + item.id + ' - ' + escape(item.name) + '(серия: ' + item.series + ')</span>' +
                '</div>';
            },
            option: function(item, escape) {
                var label = item.id + ' - ' + escape(item.name) + '(серия: ' + item.series + ')';
                return '<div>' +
                    '<span>' + escape(label) + '</span>' +
                '</div>';
            }
        },
        onInitialize: function() {
            this.selected_value = this.getValue();
            this.trigger( "change" );
        },
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				this.setValue(this.selected_value );
			}
		},
		onChange: function(value) {
			value=(!value || value==0)?this.selected_value:value;this.selected_value=value;
			if (!value.length) return;
			if (!this.options[value]) return;
            var preparation_id = this.options[value].preparation_id;

            switch (tab_index)
            {
                case 1:
                    LoadMethods(preparation_id, function(value) {});
                    LoadPreventionDiseases(preparation_id, function(value) {});
                    break;
                case 2:
                    break;
                case 3:
                    LoadMethods(preparation_id, function(value) {});
                    break;
            }

		}
    });

    select_receipts = $select_receipts[0].selectize;

	$select_service = $('#FactServiceId').selectize({
        create: false,
		//persist: false,
		selectOnTab: true,
        placeholder: 'Укажите услугу',
        onChange: function(value) {
            value=(!value || value==0)?this.selected_value:value;this.selected_value=value;
			if (!value.length) return;
            $('.preventions_only, .diagnostic_tests_only, .sanitary_works_only').hide();
            var selected_service = $.grep(services, function(e) { return e['id'] == value; })[0];
            tab_index = selected_service?selected_service['tab_index']:0;
            LoadServiceTypes(this.selected_value, function(value) { });
            switch (tab_index)
            {
                case 1:
                    $('.preventions_only').show();
                    select_diseases = $select_prev_diseases[0].selectize;
                    SetOrDisableMethod();
                    SetOrDisableDiseases();
                    LoadReceipts(function(value) {});
                    break;
                case 2:
                    $('.diagnostic_tests_only').show();
                    select_diseases = $select_test_diseases[0].selectize;
                    SetOrDisableDiseases();
                    LoadDiagnosticTestDiseases(select_service.selected_value, function(value) {});
                    LoadReceipts(function(value) {});
                    break;
                case 3:
                    $('#FactAnimalId').prop('selectedIndex',0);
                    $('.sanitary_works_only').show();
                    LoadReceipts(function(value) {});
                    break;
            }
        }
	});


// 	$('#PreparationUsedDoses').change(function(event){
// 	    LoadReceipts(function(value) {});
// 	});

	select_service =  $select_service[0].selectize;

	var SetOrDisableMethod = function() {
    	@if(null==(old('application_method_id')))
    	select_method.disable();
        @else
        select_method.setValue({{old('application_method_id')}});
    	@endif
	}

    var SetOrDisableDiseases = function() {
        @if(null==(old('diseases')))
    	select_diseases.disable();
        @else
        select_diseases.setValue({{old('diseases')}});
    	@endif
    }

	var LoadPreventionDiseases = function(preparation_id, success) {
	    select_diseases.disable();
        select_diseases.clearOptions();
        select_diseases.load(function(callback) {
            var selected_animal = $.grep(animals, function(e) { return e['id'] == $('#FactAnimalId').val(); })[0];
            console.log('animal_type_id:' + selected_animal.animal_type_id);
            xhr_diseases && xhr_diseases.abort();
            xhr_diseases = $.ajax({
                type: 'get',
                url: '/api/diseases?animal_type_id=' + selected_animal.animal_type_id + '&preparation_id=' + preparation_id,
                success: function(results) {
                    select_diseases.enable();
					success(results);
                    callback(results);
                },
                error: function() {
                    callback();
                }
            })
        });
	}

	var LoadDiagnosticTestDiseases = function(service_id, success) {
	    select_diseases.disable();
        select_diseases.clearOptions();
        select_diseases.load(function(callback) {
            xhr_diseases && xhr_diseases.abort();
            xhr_diseases = $.ajax({
                type: 'get',
                url: '/api/diseases?service_id=' + service_id,
                success: function(results) {
                    select_diseases.enable();
					success(results);
                    callback(results);
                },
                error: function() {
                    callback();
                }
            })
        });
	}

	var LoadMethods = function(preparation_id, success) {
	    select_method.disable();
		select_method.clearOptions();
		select_method.load(function(callback) {
			xhr_method && xhr_method.abort();
			xhr_method = $.ajax({
				type: 'get',
				url: '/api/preparation/' + preparation_id + '/application_methods',
				success: function(results) {
					select_method.enable();
					success(results);
					callback(results);
				},
				error: function() {
					callback();
				}
			})
		});
	}

	var LoadReceipts = function(success) {
			select_receipts.disable();
			select_receipts.clearOptions();
			var preparation_used_doses = $('#PreparationUsedDoses').val();
			select_receipts.load(function(callback) {
				xhr_receipts && xhr_receipts.abort();
				xhr_receipts = $.ajax({
				    type: 'get',
					url: '/api/subdivisions/' + {{$object->subdivision_id}} + '/preparation_receipts?service_id=' + select_service.selected_value + '&preparation_used_doses=' + preparation_used_doses,
					success: function(results) {
					    select_receipts.enable();
						success(results);
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
	}

    var LoadServiceTypes = function(service_id, success) {
	    select_service_type.disable();
		select_service_type.clearOptions();
		select_service_type.load(function(callback) {
			xhr_service_type && xhr_service_type.abort();
			xhr_service_type = $.ajax({
			    type: 'get',
				url: '/api/service/' + service_id + '/service_types',
				success: function(results) {
				    select_service_type.enable();
					success(results);
					callback(results);
				},
				error: function() {
					callback();
				}
			})
		});
	}

});

</script>
@endsection
