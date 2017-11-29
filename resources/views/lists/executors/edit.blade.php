@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/executor/{{ $executor->id }}" class="well" id="ExecutorEditForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
    	{{ method_field('PUT') }}
        <div class="form-group required">
        	<label for="executor-name">Название</label>
            <input name="name" id="executor-name" class="form-control" 
            	   placeholder="Название..." maxlength="255" type="text"
            	   value="{{ $executor->name }}">
        </div>
        <div class="form-group required">
        	<label for="executor-category_id">Категория</label>
            <select name="executor_category_id" id="executor-executor_category_id" class="form-control">
                @foreach ($executor_categories as $id => $category)
                    <option value="{{ $id }}" {{ $executor->executor_category_id == $id ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group required">
        	<label for="executor-institution_id">Учреждение</label>
            <select name="institution_id" id="executor-institution_id" class="form-control">
                @foreach ($institutions as $id => $institution)
                    <option value="{{ $id }}" {{ $executor->institution_id == $id ? 'selected' : '' }}>{{ $institution }}</option>
                @endforeach
            </select>
        </div> 
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </form>
@endsection

@section('scripts')
<script src="{{ URL::asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
	$('#executor-institution_id').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'учреждение'
	});
});
</script>
@endsection
