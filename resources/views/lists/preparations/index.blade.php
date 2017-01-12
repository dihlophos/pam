@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/preparation" class="form" id="PreparationAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="preparation-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:600px">
        </div>
        <div class="form-group">
            <select name="diseases[]" id="preparation-diseases" class="form-control"  style="min-width:200px" multiple>
                @foreach ($diseases as $id => $disease)
                    <option value="{{$id}}">{{$disease}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="services[]" id="preparation-services" class="form-control" multiple>
                @foreach ($services as $id => $service)
                    <option value="{{$id}}">{{$service}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="applicationMethods[]" id="preparation-applicationMethods" class="form-control" multiple>
                @foreach ($applicationMethods as $id => $applicationMethod)
                    <option value="{{$id}}">{{$applicationMethod}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </form>
    <br/>
  @if (count($preparations) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Болезни
      </div>

      <div class="panel-body">
        {{$preparations->links()}}
        <table class="table table-striped task-table">
            <thead>
                <th>Название</th>
                <th>Болезни</th>
                <th>Услуги</th>
                <th>Применение</th>
                <th>Удалить</th>
            </thead>
          <tbody>
            @foreach ($preparations as $preparation)
              <tr>
                <td class="table-text">
                    <a href="/lists/preparation/{{ $preparation->id }}/edit">{{ $preparation->name }}</a>
                </td>
                <td class="table-text">
                    @foreach ($preparation->diseases as $disease)
                        {{$disease->name}}
                        {{$disease!=$preparation->diseases->last()?',':''}}
                    @endforeach
                </td>
                <td class="table-text">
                    @foreach ($preparation->services as $service)
                        {{$service->name}}
                        {{$service!=$preparation->services->last()?',':''}}
                    @endforeach
                </td>
                <td class="table-text">
                    @foreach ($preparation->applicationMethods as $applicationMethod)
                        {{$applicationMethod->name}}
                        {{$applicationMethod!=$preparation->applicationMethods->last()?',':''}}
                    @endforeach
                </td>
                <td>
                    <form action="/lists/preparation/{{ $preparation->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button class="btn btn-primary">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                            Удалить
                        </button>
                    </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{$preparations->links()}}
      </div>
    </div>
   @endif
@endsection

@section('scripts')
<script src="{{ URL::asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
	$('select[name="diseases[]"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'болезни'
	});
    $('select[name="services[]"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'услуги'
	});
    $('select[name="applicationMethods[]"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'применение'
	});
});
</script>
@endsection
