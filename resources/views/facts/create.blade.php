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
    </fieldset>
    <fieldset>
        <legend>Количество</legend>
        <div class="form-group preventions_only">
            <label for="PreventionCount">Всего</label>
            <input name="count" class="form-control" type="number" id="PreventionCount" value="{{ old('count')?old('count'):0 }}">
        </div>
        <div class="form-group preventions_only">
            <label for="PreventionCountGz">По ГЗ</label>
            <input name="count_gz" class="form-control" type="number" id="PreventionCountGz" value="{{ old('count_gz')?old('count_gz'):0 }}">
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
        <div class="form-group">
            <label for="PreventionExecutorId">Исполнитель</label>
            <select name="executor_id" class="form-control" id="PreventionExecutorId">
                @foreach ($executors as $id => $executor)
                <option value="{{$id}}" {{ old('executor_id') == $id ? 'selected' : '' }}>{{ $executor }}</option>
                @endforeach
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
    <fieldset class="preventions_only diagnostic_tests_only">
        <legend>Сведения об использованиии препаратов</legend>
        <div class="form-group">
            <label for="PreparationReceiptId">Код записи препарата</label>
            <select name="preparation_receipt_id" id="PreparationReceiptId" class="form-control">
                @foreach ($preparation_receipts as $preparation_receipt)
                    <option value="{{$preparation_receipt->id}}" {{ old('preparation_receipt_id') == $preparation_receipt->id ? 'selected' : '' }}>
                        {{ $preparation_receipt->id }}-{{ $preparation_receipt->preparation->name }} (серия: {{ $preparation_receipt->series }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group required preventions_only">
            <label for="PreventionApplicationMethodId">Порядок применения</label>
            <select name="application_method_id" class="form-control" id="PreventionApplicationMethodId" required="required">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group preventions_only">
            <label for="PreventionDiseases">Болезни</label>
            <select name="diseases" class="form-control" multiple="multiple" id="PreventionDiseases">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group required preventions_only diagnostic_tests_only">
            <label for="PreparationUsedDoses">Израсходовано доз (мл)</label>
            <input name="preparation_used_doses" class="form-control" type="number"
                   value="{{ old('preparation_used_doses')?old('preparation_used_doses'):0 }}"
                   id="PreparationUsedDoses" required="required">
        </div>
        <div class="form-group preventions_only diagnostic_tests_only">
            <label for="Comment">Примечание</label>
            <input name="comment" class="form-control" maxlength="255" type="text"
                   value="{{ old('comment')?old('comment'):0 }}" id="Comment">
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
    var receipts = {!!(string)$preparation_receipts!!};

    var xhr;
	var select_receipts, $select_receipt;
    var select_method, $select_method;
	var select_diseases, $select_diseases;

    $select_method = $('#PreventionApplicationMethodId').selectize({
        valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
        create: false,
		persist: false,
		selectOnTab: true,
        plugins: ['restore_on_backspace'],
        placeholder: 'Укажите порядок применения'
    });

    select_method  = $select_method[0].selectize;

    $select_receipt = $('#PreparationReceiptId').selectize({
        create: false,
		persist: false,
		selectOnTab: true,
        plugins: ['restore_on_backspace'],
        placeholder: 'Укажите препарат',
        onInitialize: function() {this.selected_value = this.getValue(); this.trigger( "change" );},
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				this.setValue(this.selected_value );
			}
		},
		onChange: function(value) {
			value=(!value || value==0)?this.selected_value:value;this.selected_value=value;
			if (!value.length) return;
            var selected_preparation_receipt = $.grep(receipts, function(e) { return e['id'] == value; })[0];
            var preparation_id = selected_preparation_receipt?selected_preparation_receipt['preparation']['id']:0;
			select_method.disable();
			select_method.clearOptions();
			select_method.load(function(callback) {
				xhr && xhr.abort();
				xhr = $.ajax({
					type: 'get',
					url: '/api/preparation/' + preparation_id + '/application_methods',
					success: function(results) {
						select_method.enable();
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
		}
    });

    @if(null==(old('application_method_id')))
	select_method.disable();
	@endif

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
