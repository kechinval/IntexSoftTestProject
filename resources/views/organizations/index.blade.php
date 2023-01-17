@extends('welcome')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Название организации</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($organizations as $organization)
            <tr onclick="document.location = '/organizations/{{ $organization->id }}';">
                <td>{{ $organization->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection