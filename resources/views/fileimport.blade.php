@extends('master')
@section('content')

<div class="container mt-5 text-center">
    <h2 class="mb-4">
        Import CSV & Excel to Database
    </h2>

    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
{{--            <div class="custom-file text-left">--}}
{{--                <input type="file" name="file" class="custom-file-input" id="customFile">--}}
{{--                <label class="custom-file-label" for="customFile">Choose file</label>--}}
{{--            </div>--}}
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
