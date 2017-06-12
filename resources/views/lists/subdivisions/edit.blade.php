@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="/lists/subdivision/{{ $subdivision->id }}" class="well" id="SubdivisionEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>Редактирование подразделения</legend>
        <input name="institution_id" type="hidden" id="SubdivisionInstitutionId" required="required" value="{{ $subdivision->institution_id }}">
		<div class="form-group required">
            <label for="SubdivisionName">Название</label>
            <input name="name" class="form-control" maxlength="50" type="text" id="SubdivisionName" required="required" value="{{ $subdivision->name }}">
        </div>
        <div class="form-group">
            <label for="subdivision-municipality_id">Районы</label>
            <select name="municipalities[]" id="subdivision-municipality_id" class="form-control" multiple>
                @foreach ($municipalities as $id => $municipality)
                    <option value="{{$id}}" {{$subdivision->municipalities->pluck('id')->contains($id) ? 'selected' : ''}}>{{$municipality}}</option>
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
	$('select[name="municipalities[]"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'муниципальные образования'
	});
});
</script>
@endsection
