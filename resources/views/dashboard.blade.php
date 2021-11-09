@extends('master')
@section('content')
    <div class="container mt-4">
        <h3 class="text-center mb-3">Total Delivered Count</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="fa fa-code-fork"></i>
                    <span class="count-numbers">{{count($yesterday_data_count)}}</span>
                    <span class="count-name">Yesterday</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card-counter success">
                    <i class="fa fa-users"></i>
                    <span class="count-numbers">{{count($today_data_count)}}</span>
                    <span class="count-name">Today</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center mt-5">
        <h2 class="mb-4">
            Import CSV & Excel File
        </h2>

        <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <input class="form-control" type="file" name="file" id="formFile">
                <label for="formFile" class="form-label"></label>
            </div>
            <div>
                <button class="btn btn-primary">Import data</button>
{{--                <a href="{{route('create')}}" type="submit" class="btn btn-primary">Add Product</a>--}}
{{--                <a href="{{route('product-list')}}" type="submit" class="btn btn-primary">Product List</a>--}}
            </div>
            {{--        <div class="row">--}}
            {{--            --}}
            {{--        </div>--}}
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
