@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/executor" class="form-inline text-right" id="ExecutorAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="executor-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:600px">
        </div>
        <div class="form-group required">
            <select name="executor_category_id" id="executor-executor_category_id" class="form-control">
                @foreach ($executor_categories as $id => $category)
                    <option value="{{$id}}">{{$category}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </form>
    <br/>
  @if (count($executors) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
          Исполнители
      </div>

      <div class="panel-body">
        {{$executors->links()}}
        <table class="table table-striped task-table">

            <thead>
                <th>Название</th>
                <th>Удалить</th>
            </thead>

          <tbody>
            @foreach ($executors as $executor)
              <tr>
                <td class="table-text">
                    <form class="form-inline" action="/lists/executor/{{ $executor->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            <input name="name" class="form-control" value="{{ $executor->name }}" maxlength="255" type="text" style="width:520px">
                        </div>
                        <div class="form-group required">
                            <select name="executor_category_id" id="executor-executor_category_id" class="form-control" style="width:330px">
                                @foreach ($executor_categories as $id => $category)
                                    <option value="{{$id}}" {{$executor->executor_category_id == $id ? 'selected' : ''}}>{{$category}}</option>
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
                    <form action="/lists/executor/{{ $executor->id }}" method="POST">
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
        {{$executors->links()}}
      </div>
    </div>
   @endif
@endsection
