@extends('welcome')

@section('content')
   
@if ($errors->any())
    <div class="row">
        <div class="alert alert-danger">
            There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
            
   
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Фамилия:</strong>
                <input type="text" name="surname" class="form-control" placeholder="Фамилия">
            </div>
            <div class="form-group">
                <strong>Имя:</strong>
                <input type="text" name="name" class="form-control" placeholder="Имя">
            </div>
            <div class="form-group">
                <strong>Отчество:</strong>
                <input type="text" name="patronymic" class="form-control" placeholder="Отчество">
            </div>
            <div class="form-group">
                <strong>Дата рождения:</strong>
                <input type="date" name="birthdate" class="form-control" placeholder="Дата рождения">
            </div>
            <div class="form-group">
                <strong>ИНН:</strong>
                <input type="text" name="inn" class="form-control" placeholder="ИНН">
            </div>
            <div class="form-group">
                <strong>СНИЛС:</strong>
                <input type="text" name="snils" class="form-control" placeholder="СНИЛС">
            </div>       
            <div class="form-group">
                <strong>Организация:</strong>
                <select name="organizations_id[]" class="form-control" multiple="multiple">
                    @foreach ($organizations as $organization)
                        <option value='{{ $organization->id }}'>{{ $organization->name }}</option>
                    @endforeach
                </select>
            </div>  
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection