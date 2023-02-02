@extends('welcome')

@section('content')
    <div style="display: inline-flex; gap: 3em">
        <div>
            <p><b>Название организации</b></p>
            <p>{{ $organization->name }}</p>
            <p><b>ОГРН</b></p>
            <p>{{ $organization->ogrn }}</p>
            <p><b>ОКТМО</b></p>
            <p>{{ $organization->oktmo }}</p>
        </div>
        <div>
            <p><b>Сотрудники</b></p>
                @foreach ($organization->users as $user)
                    <p><a href="/users/{{$user->id}}">{{ $user->surname }} {{ $user->name }}</a></p>
                @endforeach
        </div>
    </div>
@endsection