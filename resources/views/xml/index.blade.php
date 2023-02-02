@extends('welcome')

@section('content')
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
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
