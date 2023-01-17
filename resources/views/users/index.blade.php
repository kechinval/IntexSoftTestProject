@extends('welcome')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr onclick="document.location = '/users/{{ $user->id }}';">
                <td>{{ $user->surname }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->patronymic }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection