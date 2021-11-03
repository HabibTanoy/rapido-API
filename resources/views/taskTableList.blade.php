@extends('master')
@section('content')
<h3 class="text-center my-4">Delivery Information</h3>
<div class="container">
    <form>
        <div class="row justify-content-md-center">
            <div class="col">
                <div class="form-group">
                    <label for="pure-date">Start Date</label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
{{--                            <span class="input-group-text">@</span>--}}
                        </div>
                        <input type="date" class="form-control" id="pure-date" aria-describedby="date-design-prepend">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="from-date">End Date</label>
                    <div class="input-group mb-4 constrained">
                        <div class="input-group-prepend">
{{--                            <span class="input-group-text">@</span>--}}
                        </div>
                        <input type="date" class="form-control ppDate" id="from-date" aria-describedby="date-design-prepend">
                    </div>
                </div>
            </div>
    </form>
</div>

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Phone</th>
        <th scope="col">Address</th>
        <th scope="col">Price</th>
        <th scope="col">Comment</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach( $importTableData as  $tableData)
            <tr>
                <td>{{$tableData->name}}</td>
                <td>{{$tableData->phone}}</td>
                <td>{{$tableData->address}}</td>
                <td>{{$tableData->price}}</td>
                <td>{{$tableData->comment}}</td>
                <td style="width:14%">
                    <div class="row demo">
                        <div class="col-md-4">
                            <a class="btn btn-primary" href="{{route('task-update-info', $tableData->id)}}" role="button">Edit</a>
                        </div>
                        <div class="col-md-4">
                            <form action="{{route('delete', $tableData->id)}}" method='post'>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
