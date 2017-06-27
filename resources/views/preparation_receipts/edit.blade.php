@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="/subdivision/{{$subdivision->id}}/preparation_receipt/{{$preparationReceipt->id}}" class="well" id="PreparationReceiptEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <input name="subdivision_id" type="hidden" id="PreparationReceiptSubdivisionId" value="{{ $subdivision->id }}">
    <input name="used_containers" type="hidden" id="PreparationReceiptUsedContainers" value="0">
    <div class="form-group required">
        <label for="PreparationReceiptDate">Дата записи</label>
        <input name="date" type="date" class="form-control" id="PreparationReceiptDate" value="{{ $preparationReceipt->date }}">
    </div>
    <fieldset>
		<legend>Сведения о документе</legend>
		<div class="form-group">
            <label for="PreparationReceiptDocDate">Дата</label>
            <input name="doc_date" type="date" class="form-control" id="PreparationReceiptDocDate" value="{{ $preparationReceipt->doc_date }}">
        </div>
        <div class="form-group">
            <label for="PreparationReceiptDocNum">Номер</label>
            <input name="doc_num" class="form-control" maxlength="250" type="text" id="PreparationReceiptAddress" value="{{ $preparationReceipt->doc_num }}">
        </div>
        <div class="form-group">
            <label for="PreparationReceiptBasicDocumentId">Название</label>
            <select name="basic_document_id" class="form-control" id="PreparationReceiptBasicDocumentId">
                <option value="">Укажите документ</option>
                @foreach ($basicDocuments as $id => $basicDocument)
                    <option value="{{$id}}"{{ $preparationReceipt->basic_document_id == $id ? 'selected' : '' }}>{{ $basicDocument }}</option>
                @endforeach
            </select>
        </div>
    </fieldset>
    <fieldset>
		<legend>Сведения о поступлении ветеринарных препаратов для обработок и исследований</legend>
        <div class="form-group">
            <label for="PreparationReceiptPreparationId">Название препарата</label>
            <select name="preparation_id" id="PreparationReceiptPreparationId" class="form-control">
                <option value=""></option>
                @foreach ($preparations as $id => $preparation)
                    <option value="{{$id}}" {{ $preparationReceipt->preparation_id == $id ? 'selected' : '' }}>{{ $preparation }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="PreparationReceiptSeries">Серия</label>
            <input name="series" class="form-control" maxlength="45" type="text" id="PreparationReceiptSeries" value="{{ $preparationReceipt->series }}">
        </div>
        <div class="form-group">
            <label for="PreparationReceiptContainerDoses">Количество доз (мл, г, л, кг) во флаконе (в комплекте флаконов, единице тары)</label>
            <input name="container_doses" class="form-control" type="number" step="1" id="PreparationReceiptContainerDoses" value="{{ $preparationReceipt->container_doses }}">
        </div>
        <div class="form-group">
            <label for="PreparationReceiptCountContainers">Количество флаконов (к-тов флаконов, единиц тары)</label>
            <input name="count_containers" class="form-control" type="number" step="1" id="PreparationReceiptCountContainers" value="{{ $preparationReceipt->count_containers }}">
        </div>
        <div class="form-group">
            <label for="PreparationReceiptExpireDate">Срок годности до</label>
            <input name="expire_date" type="date" class="form-control" id="PreparationReceiptExpireDate" value="{{ $preparationReceipt->expire_date }}">
        </div>
        <div class="form-group">
            <label for="PreparationReceiptPurchaseType">Вид приобретения</label>
            <select name="purchase_type" class="form-control" id="PreparationReceiptPurchaseType">
                <option value="федеральный бюджет" {{ $preparationReceipt->purchase_type == 'федеральный бюджет' ? 'selected' : '' }}>федеральный бюджет</option>
                <option value="СГЗ" {{ $preparationReceipt->purchase_type == 'СГЗ' ? 'selected' : '' }}>СГЗ</option>
                <option value="СИЦ" {{ $preparationReceipt->purchase_type == 'СИЦ' ? 'selected' : '' }}>СИЦ</option>
                <option value="ПД" {{ $preparationReceipt->purchase_type == 'ПД' ? 'selected' : '' }}>ПД</option>
            </select>
        </div>
        <div class="form-group">
            <label for="PreparationReceiptUnitPrice">Стоимость флакона (к-та, единицы тары) (руб.)</label>
            <input name="unit_price" class="form-control" step="0.1" type="number" id="PreparationReceiptUnitPrice" value="{{ $preparationReceipt->unit_price }}">
        </div>
        <div class="form-group">
            <label for="PreparationReceiptComment">Примечание</label>
            <input name="comment" class="form-control" maxlength="255" type="text" id="PreparationReceiptComment" value="{{ $preparationReceipt->comment }}">
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

	$('#PreparationReceiptPreparationId').selectize({
        create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'Укажите препарат'
		// valueField: 'id',
		// labelField: 'name',
        // placeholder: 'Укажите препарат',
		// searchField: ['name'],
		// //plugins: ['restore_on_backspace'],
		// create: false,
		// selectOnTab: true//,
		// onInitialize: function() {this.selected_value = this.getValue();},
		// onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
		// onDropdownClose: function($dropdown) {
		// 	if(this.getValue()==0) {
		// 		this.setValue(this.selected_value );
		// 	}
		// }
	});

});

</script>
@endsection
