@extends('welcome')

@section('content')
<a class="btn btn-primary mb-3" href="/users/create" role="button">Добавить сотрудника</a>

<table class="table">
    <thead>
        <tr>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr onclick="document.location = '/users/{{ $user->id }}';">
                <td>{{ $user->surname }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->patronymic }}</td>
                <td class="row" style="gap: 1em">
                     <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Update</a>
                    <form method="post" action="{{ route('users.destroy', $user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection