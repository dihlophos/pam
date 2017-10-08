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
            <label for="displayname">ФИО</label>
            <input name="displayname" class="form-control" maxlength="50" type="text"
                   id="displayname" required="required" value="{{ $user->displayname }}">
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
                @foreach ($organs as $id => $organ)
                    <option value="{{$id}}" {{$user->organ_id == $id ? 'selected' : ''}}>{{$organ}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user-institution_id">Учреждение</label>
            <select name="institution_id" id="user-institution_id" class="form-control">
                @foreach ($institutions as $id => $institution)
                    <option value="{{$id}}" {{$user->institution_id == $id ? 'selected' : ''}}>{{$institution}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user-subdivision_id">Подразделение</label>
            <select name="subdivision_id" id="user-subdivision_id" class="form-control">
                @foreach ($subdivisions as $id => $subdivision)
                    <option value="{{$id}}" {{$user->subdivision_id == $id ? 'selected' : ''}}>{{$subdivision}}</option>
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
    
});
</script>
@endsection
