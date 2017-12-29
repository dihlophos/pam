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

<form action="{{route('object.fact.update', [$object->id, $fact->id])}}" class="well" id="FactCreateForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <input name="object_id" type="hidden" id="FactObjectId" value="{{ $object->id }}">
    <fieldset>
		<legend>Сведения о документе</legend>
		<div class="form-group required">
            <label for="FactDate">Дата</label>
            <input name="date" type="date" class="form-control" required="required" id="FactDate" value="{{$fact->date?$fact->date:date('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="FactBasicDocumentId">Название</label>
            <select name="basic_document_id" id="FactBasicDocumentId" class="form-control">
                @foreach ($basic_documents as $id => $basic_document)
                    <option value="{{$id}}" {{$fact->basic_document_id == $id ? 'selected' : '' }}>{{ $basic_document }}</option>
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
                <option value="{{$service->id}}" {{$fact->service_id == $service->id ? 'selected' : '' }}>
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
                <option value="{{$id}}" {{$fact->diagnostic_test && $fact->diagnostic_test->research_type_id == $id ? 'selected' : '' }}>
                    {{ $research_type }}
                </option>
            @endforeach
            </select>
        </div>
        <div class="form-group preventions_only diagnostic_tests_only">
            <label for="FactAnimalId">Код записи сведений о животном</label>
            <select name="animal_id" id="FactAnimalId" class="form-control">
                <option value="">Укажите животное</option>
                @foreach ($animals as $animal)
                    <option value="{{$animal->id}}" {{$fact->animal_id == $animal->id ? 'selected' : '' }}>
                        {{ $animal->animalType->name }}{{$animal->name?' | '.$animal->name:''}} - (возраст: {{$animal->age}})
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
                <option value="первый раз" {{$fact->diagnostic_test && $fact->diagnostic_test->year_multiplicity == "первый раз" ? 'selected' : '' }}>первый раз</option>
                <option value="второй раз" {{$fact->diagnostic_test && $fact->diagnostic_test->year_multiplicity == "второй раз" ? 'selected' : '' }}>второй раз</option>
            </select>
        </div>
        <div class="form-group diagnostic_tests_only">
            <label for="DiagnosticTestServiceCharacteristics">Характеристика услуги</label>
            <select name="service_characteristics" class="form-control" id="DiagnosticTestServiceCharacteristics">
                <option value="первично" {{$fact->diagnostic_test && $fact->diagnostic_test->service_characteristics == "первично" ? 'selected' : '' }}>первично</option>
                <option value="вторично" {{$fact->diagnostic_test && $fact->diagnostic_test->service_characteristics == "вторично" ? 'selected' : '' }}>вторично</option>
            </select>
        </div>
    </fieldset>
    <fieldset>
        <legend>Количество</legend>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkObjectsCount">Количество объектов</label>
            <input name="objects_count" class="form-control" type="number" id="SanitaryWorkObjectsCount"
                   value="{{$fact->sanitary_work ? $fact->sanitary_work->objects_count :
                           ($fact->sanitary_work ? $fact->sanitary_work->objects_count : 0)}}">
        </div>
        <div class="form-group preventions_only diagnostic_tests_only sanitary_works_only">
            <label for="Count">Всего</label>
            <input name="count" class="form-control" type="number" id="Count"
            	   value="{{$fact->prevention ? $fact->prevention->count :
            	   			    ($fact->diagnostic_test ? $fact->diagnostic_test->count :
                                    ($fact->sanitary_work ? $fact->sanitary_work->count :0))}}">
        </div>
        <div class="form-group preventions_only diagnostic_tests_only sanitary_works_only">
            <label for="CountGz">По ГЗ</label>
            <input name="count_gz" class="form-control" type="number" id="CountGz"
                   value="{{$fact->prevention ? $fact->prevention->count_gz :
            	   			($fact->diagnostic_test ? $fact->diagnostic_test->count_gz :
                                ($fact->sanitary_work ? $fact->sanitary_work->count_gz :0))}}">
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkIndoorCount">Помещений всего (кв.м)</label>
            <input name="indoor_count" class="form-control" type="number" id="SanitaryWorkIndoorCount"
                   value="{{$fact->sanitary_work ? $fact->sanitary_work->indoor_count : 0}}">
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkIndoorCountGz">Помещений по ГЗ (кв.м)</label>
            <input name="indoor_count_gz" class="form-control" type="number" id="SanitaryWorkIndoorCountGz"
                   value="{{$fact->sanitary_work ? $fact->sanitary_work->indoor_count_gz : 0}}">
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkOutdoorCount">Территории всего (кв.м)</label>
            <input name="outdoor_count" class="form-control" type="number" id="SanitaryWorkOutdoorCount"
                   value="{{$fact->sanitary_work ? $fact->sanitary_work->outdoor_count : 0}}">
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkOutdoorCountGz">Территории по ГЗ (кв.м)</label>
            <input name="outdoor_count_gz" class="form-control" type="number" id="SanitaryWorkOutdoorCountGz"
                   value="{{$fact->sanitary_work ? $fact->sanitary_work->outdoor_count_gz : 0}}">
        </div>
        <div class="form-group preventions_only">
            <label for="PreventionCountFinal">Окончательных обработок</label>
            <input name="count_final" class="form-control" type="number" id="PreventionCountFinal"
        		   value="{{$fact->prevention ? $fact->prevention->count_final : 0}}">
        </div>
        <div class="form-group preventions_only">
            <label for="PreventionCountIll">Заболело (осложнения)</label>
            <input name="count_ill" class="form-control" type="number" id="PreventionCountIll"
            	   value="{{$fact->prevention ? $fact->prevention->count_ill : 0}}">
        </div>
        <div class="form-group preventions_only">
            <label for="PreventionCountRip">Пало, вынуж./убит</label>
            <input name="count_rip" class="form-control" type="number" id="PreventionCountRip"
            	   value="{{$fact->prevention ? $fact->prevention->count_rip : 0}}">
        </div>
        <div class="form-group diagnostic_tests_only">
            <label for="DiagnosticTestCountPositive">Положительно</label>
            <input name="count_positive" class="form-control" type="number" id="DiagnosticTestCountPositive"
            	   value="{{$fact->diagnostic_test ? $fact->diagnostic_test->count_positive : 0}}">
        </div>
        <div class="form-group">
            <label for="PreventionExecutorId">Исполнитель</label>
            <select name="executor_id" class="form-control" id="PreventionExecutorId">
                @foreach ($executors as $id => $executor)
                <option value="{{$id}}" {{$fact->executor_id == $id ? 'selected' : '' }}>{{ $executor }}</option>
                @endforeach
            </select>
        </div>
    </fieldset>
    <fieldset class="preventions_only diagnostic_tests_only sanitary_works_only">
        <legend>Сведения об использованиии препаратов</legend>
        <div class="form-group diagnostic_tests_only">
            <label for="DiagnosticTestConclusionNum">Дата, номер заключения</label>
            <input name="conclusion_num" class="form-control" maxlength="255" type="text" id="DiagnosticTestConclusionNum"
                   value="{{$fact->diagnostic_test ? $fact->diagnostic_test->conclusion_num : ''}}">
        </div>
        <div class="form-group">
            <label for="PreparationReceiptId">Код записи препарата</label>
            <select name="preparation_receipt_id" id="PreparationReceiptId" class="form-control">
                <!--@foreach ($preparation_receipts as $preparation_receipt)
                    <option value="{{$preparation_receipt->id}}" {{$fact->preparation_receipt_id == $preparation_receipt->id ? 'selected' : '' }}>
                        {{ $preparation_receipt->id }}-{{ $preparation_receipt->preparation->name }} (серия: {{ $preparation_receipt->series }})
                    </option>
                @endforeach-->
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
                   value="{{$fact->sanitary_work ? $fact->sanitary_work->temperature : 0}}" id="SanitaryWorkTemperature">
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkConcentration">Концентрация</label>
            <input name="concentration" class="form-control" type="number"
                   value="{{$fact->sanitary_work ? $fact->sanitary_work->concentration : 0}}" id="SanitaryWorkConcentration">
        </div>
        <div class="form-group sanitary_works_only">
            <label for="SanitaryWorkConsumption">Расход на кв. м</label>
            <input name="сonsumption" class="form-control" type="number"
                   value="{{$fact->sanitary_work ? $fact->sanitary_work->сonsumption : 0}}" id="SanitaryWorkConsumption">
        </div>
        <div class="form-group preventions_only diagnostic_tests_only sanitary_works_only">
            <label for="PreparationUsedDoses">Израсходовано доз (мл)</label>
            <input name="preparation_used_doses" class="form-control" type="number" id="PreparationUsedDoses"
                   value="{{$fact->prevention ? $fact->prevention->preparation_used_doses :
                   			($fact->diagnostic_test ? $fact->diagnostic_test->preparation_used_doses :
                                ($fact->sanitary_work ? $fact->sanitary_work->preparation_used_doses : 0))}}">
        </div>
        <div class="form-group preventions_only diagnostic_tests_only sanitary_works_only">
            <label for="Comment">Примечание</label>
            <input name="comment" class="form-control" maxlength="255" type="text"
                   value="{{$fact->comment?$fact->comment:'' }}" id="Comment">
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
                    LoadMethods(preparation_id, function(value) {
                        SetOrDisableMethod();
                    });
                    LoadPreventionDiseases(preparation_id, function(value) {
                        SetOrDisableDiseases(select_diseases);
                    });
                    break;
                case 2:
                    break;
                case 3:
                    LoadMethods(preparation_id, function(value) {
                        SetOrDisableMethod();
                    });
                    break;
            }
		}
    });

    select_receipts = $select_receipts[0].selectize;

	var SetOrDisableMethod = function() {
    	@if ($fact->prevention && $fact->prevention->application_method_id != null)
        	select_method.addOption({!!$fact->prevention->application_method!!});
            select_method.setValue({!!$fact->prevention->application_method_id!!});
        @elseif ($fact->sanitary_work && $fact->sanitary_work->application_method_id != null)
            select_method.addOption({!!$fact->sanitary_work->application_method!!});
            select_method.setValue({!!$fact->sanitary_work->application_method_id!!});
        @else
            select_method.disable();
        @endif
	}

    var SetOrDisableDiseases = function(select) {
        @if(null==($fact->diseases))
    	select.disable();
        @else
        select.addOption({!!$fact->diseases!!});
        select.setValue({!!$fact->diseases->pluck('id')!!});
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

	var LoadReceipts = function(service_id, success) {
		select_receipts.disable();
		select_receipts.clearOptions();
		var preparation_used_doses = $('#PreparationUsedDoses').val();
		select_receipts.load(function(callback) {
			xhr_receipts && xhr_receipts.abort();
			xhr_receipts = $.ajax({
			    type: 'get',
				url: '/api/subdivisions/' + {{$object->subdivision_id}} + '/preparation_receipts?service_id=' + service_id + '&preparation_used_doses=' + preparation_used_doses,
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

	$select_service = $('#FactServiceId').selectize({
        create: false,
		//persist: false,
		selectOnTab: true,
        placeholder: 'Укажите услугу',
        onInitialize: function() {
            this.selected_value = this.getValue();
            this.trigger( "change" );
        },
        onChange: function(value) {
            value=(!value || value==0)?this.selected_value:value;this.selected_value=value;
			if (!value.length) return;
            $('.preventions_only, .diagnostic_tests_only, .sanitary_works_only').hide();
            var selected_service = $.grep(services, function(e) { return e['id'] == value; })[0];
            tab_index = selected_service?selected_service['tab_index']:0;
            LoadServiceTypes(this.selected_value, function(value) {
                @if ($fact->service_type)
                select_service_type.addOption({!!$fact->service_type!!});
                select_service_type.setValue({!!$fact->service_type->id!!});
                @endif
            });
            switch (tab_index)
            {
                case 1:
                    $('.preventions_only').show();
                    select_diseases = $select_prev_diseases[0].selectize;
                    LoadReceipts(this.selected_value, function(value) {
                        select_receipts.addOption({!!$preparation_receipts!!});
                        select_receipts.setValue({!!$preparation_receipts->pluck('id')!!});
                    });
                    break;
                case 2:
                    $('.diagnostic_tests_only').show();
                    select_diseases = $select_test_diseases[0].selectize;
                    LoadDiagnosticTestDiseases(this.selected_value, function(value) {
                        SetOrDisableDiseases(select_diseases);
                    });
                    LoadReceipts(this.selected_value, function(value) {
                        select_receipts.addOption({!!$preparation_receipts!!});
                        select_receipts.setValue({!!$preparation_receipts->pluck('id')!!});
                    });
                    break;
                case 3:
                    $('.sanitary_works_only').show();
                    LoadReceipts(this.selected_value, function(value) {
                        select_receipts.addOption({!!$preparation_receipts!!});
                        select_receipts.setValue({!!$preparation_receipts->pluck('id')!!});
                    });
                    break;
            }
        }
	});
	select_service =  $select_service[0].selectize;

});

</script>
@endsection
