@extends('master')
@section('content')
<h3 class="text-center my-4">Delivery Information</h3>
<div class="container">
    <form action="{{route('date-filter')}}" method="get">
        @csrf
        <div class="row" style="margin-left: 100px">
            <div class="col-md-4">
                <div class="form-group">
{{--                    <label for="pure-date">Start Date</label>--}}
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                        </div>
                        <input type="date" class="form-control" name="start_date" id="pure-date" aria-describedby="date-design-prepend">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
{{--                    <label for="from-date">End Date</label>--}}
                    <div class="input-group mb-4 constrained">
                        <div class="input-group-prepend">
                        </div>
                        <input type="date" class="form-control ppDate" name="end_date" id="from-date" aria-describedby="date-design-prepend">
                    </div>
                </div>
            </div>
           <div class="col-md-4 ">
               <button class="btn btn-primary">Get Search List</button>
           </div>
        </div>
    </form>
</div>
<div class="m-4">
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
        @foreach( $import_table_data as  $tableData)
            <tr>
                <td>{{$tableData->name}}</td>
                <td>{{$tableData->phone}}</td>
                <td>{{$tableData->address}}</td>
                <td>{{$tableData->price}}</td>
                <td>{{$tableData->comment}}</td>
                <td style="width:13%">
                    <div class="row">
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
</div>
@endsection