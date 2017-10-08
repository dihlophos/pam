@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <a class="btn btn-primary" href="{{ route('user.create') }}">
      <i class="fa fa-plus" aria-hidden="true"></i>
      Добавить
    </a>
    <br/><br/>
  @if (count($users) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Пользователи
      </div>

      <div class="panel-body">
        {{$users->links()}}
        <table class="table table-striped">

            <thead>
                <th>Логин</th>
                <th>ФИО</th>
                <th>E-mail</th>
                <th>Админ</th>
                <th>Орган</th>
                <th>Учреждение</th>
                <th>Подразделение</th>
                <th>Удалить</th>
            </thead>

            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td class="table-text">
                         <a href="{{route('user.edit', $user->id)}}" class="btn btn-primary" role="button">{{ $user->username }}</a>
                    </td>
                    <td class="table-text">
                        {{ $user->displayname }}
                    </td>
                    <td class="table-text">
                        {{ $user->email }}
                    </td>
                    <td class="table-text">
                        {{ $user->is_admin?'да':'нет' }}
                    </td>
                    <td class="table-text">
                        @if (!is_null($user->organ))
                            {{ $user->organ->name }}
                        @endif
                    </td>
                    <td class="table-text">
                        @if (!is_null($user->institution))
                            {{ $user->institution->name }}
                        @endif
                    </td>
                    <td class="table-text">
                        @if (!is_null($user->subdivision))
                            {{ $user->subdivision->name }}
                        @endif
                    </td>
                    <td>
                        <form action="{{route('user.destroy', $user->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button class="btn btn-primary">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                Нет пользователей О_о
            @endforelse
            </tbody>
        </table>
        {{$users->links()}}
      </div>
    </div>
   @endif
@endsection
