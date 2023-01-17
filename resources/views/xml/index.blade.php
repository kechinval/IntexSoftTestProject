@extends('welcome')

@section('content')
@if($errors->any())

    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('xml.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row">
        <div class="mb-3">
            <label for="formFile" class="form-label">Upload xml file</label>
            <input class="form-control" type="file" id="formFile" name="file">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection