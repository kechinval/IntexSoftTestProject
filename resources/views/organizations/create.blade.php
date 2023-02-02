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
            
   
<form action="{{ route('organizations.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Название:</strong>
                <input type="text" name="name" class="form-control" placeholder="Название">
            </div>
            <div class="form-group">
                <strong>ОГРН:</strong>
                <input type="text" name="ogrn" class="form-control" placeholder="ОГРН">
            </div>
            <div class="form-group">
                <strong>ОКТМО:</strong>
                <input type="text" name="oktmo" class="form-control" placeholder="ОКТМО">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection