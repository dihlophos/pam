@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/disease" class="form-inline text-right" id="DiseaseAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="disease-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:600px">
        </div>
        <div class="form-group required">
            <select name="disease_type_id" id="disease-disease_type_id" class="form-control">
                @foreach ($disease_types as $id => $disease_type)
                    <option value="{{$id}}">{{$disease_type}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group required">
            <select name="animal_types[]" id="disease-animal_type_id" class="form-control" multiple>
                @foreach ($animal_types as $id => $animal_type)
                    <option value="{{$id}}">{{$animal_type}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </form>
    <br/>
  @if (count($diseases) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Болезни
      </div>

      <div class="panel-body">
        {{$diseases->links()}}
        <table class="table table-striped task-table">

            <thead>
                <th>Название</th>
                <th>Удалить</th>
            </thead>

          <tbody>
            @foreach ($diseases as $disease)
              <tr>
                <td class="table-text">
                    <form class="form-inline" action="/lists/disease/{{ $disease->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            <input name="name" class="form-control" value="{{ $disease->name }}" maxlength="255" type="text" style="width:580px">
                        </div>
                        <div class="form-group required">
                            <select name="disease_type_id" class="form-control">
                                @foreach ($disease_types as $id => $disease_type)
                                    <option value="{{$id}}" {{$disease->disease_type_id == $id ? 'selected' : ''}}>{{$disease_type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group required">
                            <select name="animal_types[]" id="disease-animal_type_id" class="form-control" multiple>
                                @foreach ($animal_types as $id => $animal_type)
                                    <option value="{{$id}}" {{$disease->animalTypes->pluck('id')->contains($id) ? 'selected' : ''}}>{{$animal_type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить
                            </button>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="/lists/disease/{{ $disease->id }}" method="POST">
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
        {{$diseases->links()}}
      </div>
    </div>
   @endif
@endsection
