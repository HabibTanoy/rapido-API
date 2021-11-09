@extends('master')
@section('content')
    <h2 class="text-center mt-5 mb-4">Create Delivery Details</h2>
    <div class="d-flex justify-content-center" style="margin: 0 auto;">
        <form action="{{route('create-product')}}" class="w-75" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="text1" class="col-3 col-form-label">Name</label>
                <div class="col-9">
                    <input id="text1" name="name" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="text2" class="col-3 col-form-label">Phone Number</label>
                <div class="col-9">
                    <input id="text2" name="phone" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="text5" class="col-3 col-form-label">Address</label>
                <div class="col-9">
                    <input id="text5" name="address" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="text5" class="col-3 col-form-label">Price</label>
                <div class="col-9">
                    <input id="text5" name="price" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="text3" class="col-3 col-form-label">Comment</label>
                <div class="col-9">
                    <input id="text3" name="comment" type="text" class="form-control">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Add Delivery</button>
{{--                <a href="{{route('product-list')}}" type="submit" class="btn btn-primary">Product List</a>--}}
            </div>
        </form>

@endsection
