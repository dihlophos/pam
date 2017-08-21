@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/agesex" class="" id="AgesexAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="agesex-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:800px">
        </div>
        <div class="form-group">
            <select name="animal_types[]" id="agesex-animal_type_id" class="form-control" multiple>
                @foreach ($animal_types as $id => $animal_type)
                    <option value="{{$id}}">{{$animal_type}}</option>
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
  @if (count($agesexes) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Половозрастные группы
      </div>

      <div class="panel-body">
        {{$agesexes->links()}}
        <table class="table table-striped task-table">

          <thead>
            <th>Название</th>
            <th>Виды животных</th>
            <th>Удалить</th>
          </thead>

          <tbody>
            @foreach ($agesexes as $agesex)
              <tr>
                <td>
                  <a class="table-text" href="{{ route('agesex.edit', $agesex->id) }}">{{$agesex->name}}</a>
                </td>
                <td>
                  @foreach ($agesex->animal_types as $animal_type)
                    {{ $animal_type->name . ($animal_type!=$agesex->animal_types->last() ? ',' : '') }}
                  @endforeach
                </td>
                <td>
                    <form action="/lists/agesex/{{ $agesex->id }}" method="POST">
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
        {{$agesexes->links()}}
      </div>
    </div>
   @endif
@endsection

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
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
