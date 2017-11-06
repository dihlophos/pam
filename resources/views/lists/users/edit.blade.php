@extends('layouts.app')
@section('styles')
<link href="{{ asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="{{route('user.update', $user->id)}}" class="well" id="UserEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>Редактирование пользователя</legend>
		<div class="form-group required">
            <label for="username">Логин</label>
            <input name="username" class="form-control" maxlength="50" type="text"
                   id="username" required="required" value="{{ $user->username }}">
        </div>
        <div class="form-group required">
            <label for="user-change_password" class="checkbox-inline">
                <input name="change_password" id="user-change_password" type="checkbox" value="1">Сменить пароль
            </label>
        </div>
        <div class="form-group required">
            <input name="password" id="user-password" class="form-control" placeholder="Пароль"
                   maxlength="255" type="password" disabled="disabled">
        </div>
        <div class="form-group required">
            <input name="password_confirm" id="user-password_confirm" class="form-control" placeholder="Пароль еще раз"
                   maxlength="255" type="password" disabled="disabled">
        </div>
        <div class="form-group required">
            <label for="displayname">ФИО</label>
            <input name="displayname" class="form-control" maxlength="50" type="text"
                   id="displayname" required="required" value="{{ $user->displayname }}">
        </div>
        <div class="form-group required">
            <label for="user-email">Email</label>
            <input name="email" class="form-control" maxlength="50" type="text"
                   id="user-email" required="required" value="{{ $user->email }}">
        </div>
        <div class="form-group required">
            <!--label for="user-is_admin">Администратор?</label>
            <input name="is_admin" id="user-is_admin" class="checkbox" type="checkbox" value="{{$user->is_admin}}" {{$user->is_admin?"checked":""}}-->
            <label for="user-is_admin" class="checkbox-inline">
                <input name="is_admin" id="user-is_admin" type="checkbox" value="1" {{$user->is_admin?"checked":""}}>Администратор
            </label>
        </div>
        <div class="form-group">
            <label for="user-organ_id">Управление</label>
            <select name="organ_id" id="user-organ_id" class="form-control">
                <option value=""></option>
                @foreach ($organs as $id => $organ)
                    <option value="{{$id}}" {{$user->organ_id == $id ? 'selected' : ''}}>{{$organ}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user-institution_id">Учреждение</label>
            <select name="institution_id" id="user-institution_id" class="form-control">
                <option value=""></option>
                @foreach ($institutions as $id => $institution)
                    <option value="{{$id}}" {{$user->institution_id == $id ? 'selected' : ''}}>{{$institution}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user-subdivision_id">Подразделение</label>
            <select name="subdivision_id" id="user-subdivision_id" class="form-control">
                <option value=""></option>
                @foreach ($subdivisions as $id => $subdivision)
                    <option value="{{$id}}" {{$user->subdivision_id == $id ? 'selected' : ''}}>{{$subdivision}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user-object">Объекты</label>
            <select name="objects[]" id="user-object" class="form-control" multiple>
                <option value=""></option>
                @foreach ($objects as $id => $object)
                    <option value="{{$id}}" {{$user->objects->contains($id) ? 'selected' : ''}}>{{$object}}</option>
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
<script src="{{ asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {

	var xhr;
	var select_organ, $select_organ;
	var select_institution, $select_institution;
	var select_subdivision, $select_subdivision;
	var select_objects, $select_objects;
	
	$('#user-change_password').change(function() {
	    if($(this).is(":checked")) {
	        $('#user-password').prop('disabled', false);
	        $('#user-password_confirm').prop('disabled', false);
	    } else {
	        $('#user-password').prop('disabled', true);
	        $('#user-password_confirm').prop('disabled', true);
	    }
	})
	
	$('#user-is_admin').change(function() {
	     if($(this).is(":checked")) {
	        select_organ.setValue("", true);
	        select_organ.disable();
            select_institution.disable();
		    select_institution.setValue("", true);
		    select_subdivision.disable();
		    select_subdivision.setValue("", true);
	     } else {
	         select_organ.enable();
	     }
	})
	
	$select_objects = $('#user-object').selectize({
		valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
		create: false,
		selectOnTab: true,
		onInitialize: function() {this.selected_value = this.getValue();},
		onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
	});

    $select_organ = $('#user-organ_id').selectize({
		create: false,
		selectOnTab: true,
		valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
		onInitialize: function() {this.selected_value = this.getValue();},
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				//this.setValue(this.selected_value );
				select_institution.disable();
			    select_institution.clearOptions();
			}
		},
		onChange: function(value) {
			value=(!value || value==0)?this.selected_value:value;this.selected_value=value;
			if (!value.length) return;
			select_institution.disable();
			select_institution.clearOptions();
			select_institution.load(function(callback) {
				xhr && xhr.abort();
				xhr = $.ajax({
					type: 'get',
					url: '/api/organs/'+select_organ.selected_value+'/institutions',
					success: function(results) {
						select_institution.enable();
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});

	$select_institution = $('#user-institution_id').selectize({
		create: false,
		selectOnTab: true,
		valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
		onInitialize: function() {this.selected_value = this.getValue();},
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				select_subdivision.disable();
			    select_subdivision.clearOptions();
			}
		},
		onChange: function(value) {
			value=(!value || value==0)?this.selected_value:value;this.selected_value=value;
			if (!value.length) return;
			select_subdivision.disable();
			select_subdivision.clearOptions();
			select_subdivision.load(function(callback) {
				xhr && xhr.abort();
				xhr = $.ajax({
					type: 'get',
					url: '/api/institutions/'+select_institution.selected_value+'/subdivisions',
					success: function(results) {
						select_subdivision.enable();
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});

	$select_subdivision = $('#user-subdivision_id').selectize({
		valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
		create: false,
		selectOnTab: true,
		onInitialize: function() {this.selected_value = this.getValue();},
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				select_objects.disable();
			    select_objects.clearOptions();
			}
		},
		onChange: function(value) {
			value=(!value || value==0)?this.selected_value:value;this.selected_value=value;
			if (!value.length) return;
			select_objects.disable();
			select_objects.clearOptions();
			select_objects.load(function(callback) {
				xhr && xhr.abort();
				xhr = $.ajax({
					type: 'get',
					url: '/api/subdivisions/' + select_subdivision.selected_value + '/objects',
					success: function(results) {
						select_objects.enable();
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});

    select_organ = $select_organ[0].selectize;
	select_subdivision = $select_subdivision[0].selectize;
	select_institution = $select_institution[0].selectize;
	select_objects = $select_objects[0].selectize;
	@if($user->is_admin)
	select_organ.disable();
	@endif
	@if(null==($user->organ_id))
	select_institution.disable();
	@endif
	@if(null==($user->institution_id))
	select_subdivision.disable();
	@endif
	@if(null==($user->subdivision_id))
	select_objects.disable();
	@endif
});
</script>
@endsection