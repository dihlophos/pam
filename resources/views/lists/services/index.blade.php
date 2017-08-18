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
                @foreach ($tabs as $id => $tab_name)
                    <option value="{{$id}}">{{$tab_name}}</option>
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
                <th>Категория</th>
                <th>Виды услуги</th>
                <th>Единица измерения</th>
                <th>Раздел (закладка)</th>
                <th>Удалить</th>
            </thead>

          <tbody>
            @foreach ($services as $service)
              <tr>
                <td>
                  <a class="table-text" href="{{ route('service.edit', $service->id) }}">{{ $service->name }}</a>
                </td>
                <td class="table-text">
                    {{ $service->service_category != null ? $service->service_category->name : '' }}
                </td>
                <td class="table-text">
                    @foreach ($service->service_types as $service_type)
                        {{ $service_type->name . ($service_type!=$service->service_types->last() ? ',' : '') }}
                    @endforeach
                </td>
                <td class="table-text">
                    {{ $service->measure != null ? $service->measure->name : '' }}
                </td>
                <td class="table-text">
                    {{ $tabs[$service->tab_index] }}
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
