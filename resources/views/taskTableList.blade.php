@extends('master')
@section('content')
<h3 class="text-center my-4">Delivery Information</h3>
    <form action="{{route('date-filter')}}" method="get">
        @csrf
        <div class="row" style="margin-left: 100px">
            <div class="col-md-3">
                <div class="form-group">
{{--                    <label for="pure-date">Start Date</label>--}}
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                        </div>
                        <input type="date" class="form-control" name="start_date" id="pure-date" aria-describedby="date-design-prepend">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
{{--                    <label for="from-date">End Date</label>--}}
                    <div class="input-group mb-4 constrained">
                        <div class="input-group-prepend">
                        </div>
                        <input type="date" class="form-control ppDate" name="end_date" id="from-date" aria-describedby="date-design-prepend">
                    </div>
                </div>
            </div>
           <div class="col-md-3" >
               <button class="btn btn-primary">Get Search List</button>
           </div>
            <div class="col-md-3" style="padding-left: 33px">
                <a href="{{route('create')}}" type="submit" class="btn btn-primary" >Add Product</a>
                <a href="{{route('dashboard')}}" type="submit" class="btn btn-primary">Import Files</a>
            </div>
        </div>
    </form>
{{--</div>--}}
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
        @foreach( $list_of_product as  $product_list)
            <tr>
                <td>{{$product_list->name}}</td>
                <td>{{$product_list->phone}}</td>
                <td>{{$product_list->address}}</td>
                <td>{{$product_list->price}}</td>
                <td>{{$product_list->comment}}</td>
                <td style="width:13%">
                    <div class="row">
                        <div class="col-md-4">
                            <a class="btn btn-primary" href="{{route('task-update-info', $product_list->id)}}" role="button">Edit</a>
                        </div>
                        <div class="col-md-4">
                            <form action="{{route('delete', $product_list->id)}}" method='post'>
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
