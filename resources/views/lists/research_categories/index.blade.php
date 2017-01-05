@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/research_category" class="form-inline text-right" id="ResearchCategoryAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="research_category-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:800px">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i> Добавить
            </button>
        </div>
    </form>
    <br/>
  @if (count($research_categories) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Категории исследований
      </div>

      <div class="panel-body">
        {{$research_categories->links()}}
        <table class="table table-striped task-table">

          <thead>
            <th>Название</th>
            <th>Удалить</th>
          </thead>

          <tbody>
            @foreach ($research_categories as $research_category)
              <tr>
                <td class="table-text">
                    <form class="form-inline" action="/lists/research_category/{{ $research_category->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            <input name="name" class="form-control" value="{{ $research_category->name }}" maxlength="255" type="text" style="width:800px">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить
                            </button>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="/lists/research_category/{{ $research_category->id }}" method="POST">
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
        {{$research_categories->links()}}
      </div>
    </div>
   @endif
@endsection
