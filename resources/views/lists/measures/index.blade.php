@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/measure" class="form-inline text-right" id="MeasureAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="measure-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:800px">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i> Добавить
            </button>
        </div>
    </form>
    <br/>
  @if (count($measures) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Единицы учета
      </div>

      <div class="panel-body">
        {{$measures->links()}}
        <table class="table table-striped task-table">

          <thead>
            <th>Название</th>
            <th>Удалить</th>
          </thead>

          <tbody>
            @foreach ($measures as $measure)
              <tr>
                <td class="table-text">
                    <form class="form-inline" action="/lists/measure/{{ $measure->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            <input name="name" class="form-control" value="{{ $measure->name }}" maxlength="255" type="text" style="width:800px">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить
                            </button>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="/lists/measure/{{ $measure->id }}" method="POST">
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
        {{$measures->links()}}
      </div>
    </div>
   @endif
@endsection
