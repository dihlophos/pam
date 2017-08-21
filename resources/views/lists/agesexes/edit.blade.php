@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="{{ route('agesex.update', $agesex->id) }}" class="well" id="AgesexEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>Редактирование половозрастной группы</legend>
		<div class="form-group required">
            <label for="AgesexName">Название</label>
            <input name="name" class="form-control" maxlength="50" type="text" id="AgesexName" required="required" value="{{ $agesex->name }}">
        </div>
        <div class="form-group">
            <label for="agesex-animal_type_id">Виды животных</label>
            <select name="animal_types[]" id="agesex-animal_type_id" class="form-control" multiple>
                @foreach ($animal_types as $id => $animal_type)
                    <option value="{{$id}}" {{$agesex->animal_types->pluck('id')->contains($id) ? 'selected' : ''}}>{{$animal_type}}</option>
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
	$('select[name="animal_types[]"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'виды животных'
	});
});
</script>
@endsection
