@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/research_type" class="form-inline text-right" id="ResearchTypeAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="research_type-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:600px">
        </div>
        <div class="form-group required">
            <select name="research_category_id" id="research_type-research_category_id" class="form-control">
                @foreach ($research_categories as $id => $category)
                    <option value="{{$id}}">{{$category}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </form>
    <br/>
  @if (count($research_types) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Виды исследований
      </div>

      <div class="panel-body">
        {{$research_types->links()}}
        <table class="table table-striped task-table">

            <thead>
                <th>Название</th>
                <th>Удалить</th>
            </thead>

          <tbody>
            @foreach ($research_types as $research_type)
              <tr>
                <td class="table-text">
                    <form class="form-inline" action="/lists/research_type/{{ $research_type->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            <input name="name" class="form-control" value="{{ $research_type->name }}" maxlength="255" type="text" style="width:580px">
                        </div>
                        <div class="form-group required">
                            <select name="research_category_id" id="research_type-research_category_id" class="form-control" style="width:270px">
                                @foreach ($research_categories as $id => $category)
                                    <option value="{{$id}}" {{$research_type->research_category_id == $id ? 'selected' : ''}}>{{$category}}</option>
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
                    <form action="/lists/research_type/{{ $research_type->id }}" method="POST">
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
        {{$research_types->links()}}
      </div>
    </div>
   @endif
@endsection
