@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/organ" class="form-inline" id="OrganAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="organ-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:700px">
        </div>
        <div class="form-group required">
            <select name="region_id" id="organ-region_id" class="form-control"  style="width:250px">
                @foreach ($regions as $id => $region)
                    <option value="{{$id}}">{{$region}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i> Добавить
            </button>
        </div>
    </form>
    <br/>
  @if (count($organs) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Органы
      </div>

      <div class="panel-body">
        {{$organs->links()}}
        <table class="table table-striped task-table">

          <thead>
            <th>Название</th>
            <th>Регион</th>
            <th>Удалить</th>
          </thead>

          <tbody>
            @foreach ($organs as $organ)
              <tr>
                <td class="table-text">
                    <a href="/lists/organ/{{ $organ->id }}/edit">{{ $organ->name }}</a>
                </td>
                <td class="table-text">
                    {{ $organ->region?$organ->region->name:'' }}
                </td>
                <td>
                    <form action="/lists/organ/{{ $organ->id }}" method="POST">
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
        {{$organs->links()}}
      </div>
    </div>
   @endif
@endsection

@section('scripts')
<script src="{{ URL::asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
	$('select[name="region_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'регион'
	});
});
</script>
@endsection
