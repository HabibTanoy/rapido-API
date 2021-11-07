@extends('master')
@section('content')

<div class="container text-center" style="margin-top: 200px">
    <h2 class="mb-4">
        Import CSV & Excel File
    </h2>

    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <input class="form-control" type="file" name="file" id="formFile">
                <label for="formFile" class="form-label"></label>
        </div>
        <button class="btn btn-primary mb-3">Import data</button>
        @if(session('errorMessage'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('errorMessage') }}
            </div>
        @endif
{{--        @if(session('message'))--}}
{{--            <div class="alert alert-success" role="alert">--}}
{{--                {{ session()->get('message') }}--}}
{{--            </div>--}}
{{--        @endif--}}

    </form>
</div>
@endsection
