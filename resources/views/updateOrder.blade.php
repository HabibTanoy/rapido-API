@extends('master')
@section('content')
    <h3 class="text-center my-4">Update Delivery Information</h3>
    <div class="d-flex justify-content-center" style="margin: 0 auto;">
        <form action="{{route('order-update', $order_update->id)}}" class="w-75" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="text1" class="col-3 col-form-label">Name</label>
                <div class="col-9">
                    <input id="text1" name="name" type="text" class="form-control" value="{{$order_update->name}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="text2" class="col-3 col-form-label">Phone Number</label>
                <div class="col-9">
                    <input id="text2" name="phone" type="text" class="form-control" value="{{$order_update->phone}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="text5" class="col-3 col-form-label">Address</label>
                <div class="col-9">
                    <input id="text5" name="address" type="text" class="form-control" value="{{$order_update->address}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="text3" class="col-3 col-form-label">Comment</label>
                <div class="col-9">
                    <input id="text3" name="comment" type="text" class="form-control" value="{{$order_update->comment}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="text3" class="col-3 col-form-label">Status</label>
                <div class="col-9">
                    <select class="form-select" name="update_status" aria-label="Default select example">
{{--                        <option selected>Open this select menu</option>--}}
                        <option value="assigned">Assigned</option>
                        <option value="delivered">Delivered</option>
                        <option value="returned">Returned</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
{{--            <div class="form-group row">--}}
{{--                <label for="text3" class="col-3 col-form-label">Assigned_to</label>--}}
{{--                <div class="col-9">--}}
{{--                    <select class="form-select" aria-label="Default select example">--}}
{{--                        <option selected>name</option>--}}
{{--                        <option name="" value="1">Assigned</option>--}}
{{--                        <option name="" value="2">Delivered</option>--}}
{{--                        <option name="" value="3">Return</option>--}}
{{--                        <option name="" value="3">Cancel</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
@endsection
