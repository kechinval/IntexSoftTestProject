@extends('welcome')

@section('content')
    <div style="display: inline-flex; gap: 3em">
        <div>
            <p><b>Фамилия имя отчество</b></p>
            <p>{{ $user->surname }} {{ $user->name }} {{ $user->patronymic }}</p>
            <p><b>Дата рождения</b></p>
            <p>{{ $user->birthdate }}</p>
            <p><b>ИНН</b></p>
            <p>{{ $user->inn }}</p>
            <p><b>СНИЛС</b></p>
            <p>{{ $user->snils }}</p>
        </div>
        <div>
            <p><b>Организация</b></p>
            <p>{{ $user->org_name }}</p>
        </div>
    </div>
@endsection