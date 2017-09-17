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
              <th>Препарат</th>
              <th>Количество единиц тары</th>
          </thead>

        <tbody>
          @foreach ($data as $preparation_receipt)
            <tr>
              <td class="table-text">
                  {{ $preparation_receipt->preparation }}
              </td>
              <td class="table-text">
                  {{ $preparation_receipt->count_containers }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </div>
@endsection
