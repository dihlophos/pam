@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/region" class="form-inline text-right" id="RegionAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="region-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:800px">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i> Добавить
            </button>
        </div>
    </form>
    <br/>
  @if (count($regions) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Регионы
      </div>

      <div class="panel-body">
        {{$regions->links()}}
        <table class="table table-striped task-table">

          <thead>
            <th>Название</th>
            <th>Удалить</th>
          </thead>

          <tbody>
            @foreach ($regions as $region)
              <tr>
                <td class="table-text">
                    <a href="/lists/region/{{ $region->id }}/edit">{{ $region->name }}</a>
                </td>
                <td>
                    <form action="/lists/region/{{ $region->id }}" method="POST">
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
        {{$regions->links()}}
      </div>
    </div>
   @endif
@endsection
