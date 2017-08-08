@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/service" class="form" id="ServiceAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="service-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:600px">
        </div>
        <div class="form-group required">
            <select name="service_category_id" id="service-service_category_id" class="form-control" style="min-width:200px">
                @foreach ($service_categories as $id => $category)
                    <option value="{{$id}}">{{$category}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="service_types[]" id="service-service_types" class="form-control"  style="min-width:200px" multiple>
                @foreach ($service_types as $id => $service_type)
                    <option value="{{$id}}">{{$service_type}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group required">
            <select name="measure_id" id="service-measure_id" class="form-control" style="min-width:197px">
                @foreach ($measures as $id => $measure)
                    <option value="{{$id}}">{{$measure}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group required">
            <select name="tab_index" id="service-tab_index" class="form-control" style="min-width:141px">
                @foreach ($tabs as $idx => $tab_name)
                    <option value="{{$idx}}">{{$tab_name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </form>
    <br/>
  @if (count($services) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Услуги
      </div>

      <div class="panel-body">
        {{$services->links()}}
        <table class="table table-striped task-table">

            <thead>
                <th>Название</th>
                <th>Удалить</th>
            </thead>

          <tbody>
            @foreach ($services as $service)
              <tr>
                <td class="table-text">
                    <form class="form-inline" action="/lists/service/{{ $service->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            <input name="name" class="form-control" value="{{ $service->name }}" maxlength="255" type="text" style="width:340px">
                        </div>
                        <div class="form-group required">
                            <select name="service_category_id" id="service-service_category_id" class="form-control" style="width:243px">
                                @foreach ($service_categories as $id => $category)
                                    <option value="{{$id}}" {{$service->service_category_id == $id ? 'selected' : ''}}>{{$category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group required">
                            <select name="measure_id" id="service-measure_id" class="form-control" style="width:197px">
                                @foreach ($measures as $id => $measure)
                                    <option value="{{$id}}" {{$service->measure_id == $id ? 'selected' : ''}}>{{$measure}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group required">
                            <select name="tab_index" id="service-tab_index" class="form-control" style="width:141px">
                                @foreach ($tabs as $idx => $tab_name)
                                    <option value="{{$idx}}" {{$service->tab_index == $idx ? 'selected' : ''}}>{{$tab_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="/lists/service/{{ $service->id }}" method="POST">
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
        {{$services->links()}}
      </div>
    </div>
   @endif
@endsection

@section('scripts')
<script src="{{ URL::asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
  
  $('#service-service_types').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'виды услуг'
	});
	
	$('select').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
	});
	
});

</script>
@endsection
