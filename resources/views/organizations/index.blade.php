@extends('welcome')

@section('content')
<a class="btn btn-primary mb-3" href="/organizations/create" role="button">Добавить организацию</a>

<table class="table">
    <thead>
        <tr>
            <th>Название организации</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($organizations as $organization)
            <tr onclick="document.location = '/organizations/{{ $organization->id }}';">
                <td>{{ $organization->name }}</td>
                <td>
                    <div class="row" style="gap: 1em">
                        <a class="btn btn-primary" href="{{ route('organizations.edit', ['organization' => $organization->id]) }}">Update</a>
                        <form method="post" action="{{ route('organizations.destroy', ['organization' => $organization->id])}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection