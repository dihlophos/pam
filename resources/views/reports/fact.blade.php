@extends('layouts.app')

@section('content')
<!-- Отображение ошибок проверки ввода -->
@include('common.errors')
@include('common.flash')

<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <h1 class="panel-title pull-left" style="padding-top: 7.5px;">{{ $title }}</h1>
    </div>
    <div class="panel-body">
    @if (count($data) > 0)
      <table class="table table-striped task-table">

          <thead>
              <th>Услуга</th>
              <th>Вид животного</th>
              <th>Половозрастая группа</th>
              <th>Количество</th>
          </thead>

        <tbody>
          @foreach ($data as $fact)
            <tr>
              <td class="table-text">
                  {{ $fact->service }}
              </td>
              <td class="table-text">
                  {{ $fact->animal_type }}
              </td>
              <td class="table-text">
                  {{ $fact->agesex }}
              </td>
              <td class="table-text">
                  {{ $fact->count }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </div>
@endsection
