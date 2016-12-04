@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/disease_type" class="form-inline text-right" id="DiseaseTypeAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="disease_type-name" class="form-control" placeholder="Название..." maxlength="255" type="text">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i> Добавить
            </button>
        </div>
    </form>
    <br/>
  @if (count($disease_types) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Виды болезней
      </div>

      <div class="panel-body">
        <table class="table table-striped task-table">

          <thead>
            <th>Название</th>
            <th>Удалить</th>
          </thead>

          <tbody>
            @foreach ($disease_types as $disease_type)
              <tr>
                <td class="table-text">
                    <form class="form-inline" action="/disease_type/{{ $disease_type->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            <input name="name" class="form-control" value="{{ $disease_type->name }}" maxlength="255" type="text" style="width:800px">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить
                            </button>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="/disease_type/{{ $disease_type->id }}" method="POST">
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
      </div>
    </div>
   @endif
@endsection
